

create table wnk_cdr (
 id           character varying(36) not null primary key,
 created      timestamp with time zone default ('now'::text)::timestamp with time zone,
 email        character varying(255),
 sts          character(1) default 'o'::bpchar not null,   /* o=open/pending, x=executed */
 target_table character varying(60) not null,
 target_id    integer,
 target_uuid  character varying(36),
 target_op    character(1) default 'u'::bpchar,  /* i=insert, u=update, d=delete */
 data_old     character varying(4000),
 data_new     character varying(4000),
 remarks      character varying(255),
 sourcecty    character varying(3),
 sourceip     character varying(40)
);
