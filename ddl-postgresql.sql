

create table wnk_cdr (
 id           character varying(36) not null primary key,
 created      timestamp with time zone default ('now'::text)::timestamp with time zone,
 email        character varying(255),
 sts          character(1) default 'o'::bpchar not null,
 target_table character varying(60) not null,
 target_id    integer,
 target_uuid  character varying(36),
 target_op    character(1) default 'u'::bpchar,
 data_old     character varying(2000),
 data_new     character varying(2000),
 cdr_remark   character varying(255)
);
