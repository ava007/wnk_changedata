<?php
namespace WnkChangeData\Controller;
use WnkChangeData\Controller\AppController;
use Cake\Utility\Text;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Changes Controller
 *
 *
 * @method \WnkChangeData\Model\Entity\Change[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChangesController extends AppController {

  public $paginate = ['limit' => 25, 'order' => ['Changes.created' => 'desc' ] ];

  public function initialize() {
    parent::initialize();
    $this->loadComponent('Paginator');
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
  */
  public function add() {
    $this->log('PluginWCD:CChanges:add getData():' . print_r($this->request->getData(),true));

    // https://www.ampproject.org/docs/fundamentals/amp-cors-requests

    $this->response = $this->response->cors($this->request)
      ->allowOrigin(['*.cdn.ampproject.org','*.locavores.co'])
      ->allowMethods(['GET', 'POST'])
      ->allowHeaders(['X-CSRF-Token'])
      ->allowCredentials()
      ->exposeHeaders(['Link','AMP-Access-Control-Allow-Source-Origin'])
      ->maxAge(300)
      ->build();

    $this->response = $this->response->withAddedHeader('AMP-Access-Control-Allow-Source-Origin', 'https://www.locavores.co');

    $change = $this->Changes->newEntity();
    if ($this->request->is('post')) {
      $change = $this->Changes->patchEntity($change, $this->request->getData());
      $change->id = Text::uuid();
      $change->sourcecty = env('GEOIP_CITY_COUNTRY_CODE');
      $change->sourceip = env('REMOTE_ADDR');
      $change->sts = 'o';

      $data = $this->request->getData();
      $olddata = [];
      foreach ($data as $k => $v) {
        if (substr($k,0,3) == 'old') {
           $olddata[substr($k,4)] = $v;
        }
      }
      $change->data_old = json_encode($olddata);

      $newdata = [];
      foreach ($data as $k => $v) {
        if (substr($k,0,3) == 'new') {
          $newdata[substr($k,4)] = $v;
        }
      }
      $change->data_new = json_encode($newdata);

      $change->target_table = $data['target_table'];

      if ($this->Changes->save($change)) {
        $this->Flash->success(__('The change has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The change could not be saved. Please, try again.'));
    }
    $this->set(compact('change'));
    $this->autoRender = false;
    return $this->response;
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|void
   */
  public function index() {
        $changes = $this->paginate($this->Changes);

        $this->set(compact('changes'));
    }

    /**
     * View method
     *
     * @param string|null $id Change id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $change = $this->Changes->get($id, [
            'contain' => []
        ]);

        $this->set('change', $change);
    }

    /**
     * Edit method
     *
     * @param string|null $id Change id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $change = $this->Changes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $change = $this->Changes->patchEntity($change, $this->request->getData());
            if ($this->Changes->save($change)) {
                $this->Flash->success(__('The change has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The change could not be saved. Please, try again.'));
        }
        $this->set(compact('change'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Change id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $change = $this->Changes->get($id);
        if ($this->Changes->delete($change)) {
            $this->Flash->success(__('The change has been deleted.'));
        } else {
            $this->Flash->error(__('The change could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

  public function approve($id = null) {

    $crec = $this->Changes->get($id);

    $j = json_decode($crec->data_new);

    $this->log('Ccdr::approved: cdr-rec' . print_r($crec,true) . "\nJson:" . print_r($j,true));

    $table = TableRegistry::get($crec->target_table);  // import target class

    if ($crec->target_op == 'd') {
       $tc->delete($j->id);
    } elseif  ($crec->target_op == 'u') {
      $urec = $table->get($crec->target_id);

      foreach($j as $attr => $value) {
        if ($attr == 'id') continue;
        if ($attr == 'realm_id') continue;   // this attr cannot be changed
           

        if (isset($value->year) and empty($value->year)) continue;            

        if (isset($value->year)) {
           $value =  CakeTime::format('Y-m-d', $value->year . '-'. $value->month . '-'. $value->day);
        }
        $this->log('Ccdr::approve : saved '.print_r($attr,true).' with value: '.print_r($value,true));
        if (empty($value)) 
          $urec->$attr = null;
        else 
          $urec->$attr = $value;
      }
      $this->log('Ccdr::approved : new data: "'.print_r($urec,true));
      if ($table->save($urec)){
         $rid = $urec->realm_id;
      } else {
         $this->log('Ccdr::approved but not saved with data: "'.print_r($urec,true));
      }
    } else {
      // create new object, fill all mandatory values!!
      $nrec = $table->newEntity();
     
      foreach($j as $attr => $value) {
        if ($attr == 'id') continue;
        if ($attr == 'request_oper') continue;
        if ($attr == 'request_remark') continue;
        if (empty($value)) continue;
        if (isset($value->year)) {
            if (!empty($value->year)) {
              $value =  CakeTime::format('Y-m-d', $value->year . '-'. $value->month . '-'. $value->day);
            } else {
              continue;
            }
         }
         $nrec[$attr] = $value;
         $this->log('Ccdr::approve : created:  with value: "' . print_r($nrec,true) . '"');
       }
      $table->save($nrec);
      $rid = $nrec->realm_id;
    }

    if (!empty($rid)) {
      $rTable = TableRegistry::get('Realms');
      $r = $rTable->get($rid); // Return article with id 12

      $r->modified = Time::now();
      $rTable->save($r);
    }

    // Mark request as executed:
    $crec->sts = 'x';
    $this->Changes->save($crec);

    $this->Flash->set( __('Translation Saved'));
    $this->redirect('/wnk-change-data/changes/index');
  }
}
