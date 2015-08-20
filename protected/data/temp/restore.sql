--
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.usr_profiles DROP CONSTRAINT usr_profiles_user_id_fkey;
ALTER TABLE ONLY public."usr_AuthItemChild" DROP CONSTRAINT "usr_AuthItemChild_parent_fkey";
ALTER TABLE ONLY public."usr_AuthItemChild" DROP CONSTRAINT "usr_AuthItemChild_child_fkey";
ALTER TABLE ONLY public."usr_AuthAssignment" DROP CONSTRAINT "usr_AuthAssignment_itemname_fkey";
ALTER TABLE ONLY public.nav_items DROP CONSTRAINT "nav_items_menuId_fkey";
ALTER TABLE ONLY public.photo_gallery_photos DROP CONSTRAINT gallery_photo;
ALTER TABLE ONLY public.vote_item DROP CONSTRAINT fk_vote_item;
ALTER TABLE ONLY public.documents DROP CONSTRAINT document_folder;
ALTER TABLE ONLY public.committee_staff DROP CONSTRAINT committee_department_id;
ALTER TABLE ONLY public.committee_department DROP CONSTRAINT committee_department_id;
DROP INDEX public.usr_users_username;
DROP INDEX public.usr_users_email;
DROP INDEX public."usr_AuthItemChild_child";
DROP INDEX public.nav_items_parent_id;
DROP INDEX public."nav_items_menuId";
ALTER TABLE ONLY public.yiicache DROP CONSTRAINT yiicache_pkey;
ALTER TABLE ONLY public.vote_user DROP CONSTRAINT vote_user_pkey;
ALTER TABLE ONLY public.vote DROP CONSTRAINT vote_pkey;
ALTER TABLE ONLY public.vote_item DROP CONSTRAINT vote_item_pkey;
ALTER TABLE ONLY public.video_gallery_videos DROP CONSTRAINT video_pkey;
ALTER TABLE ONLY public.video_gallery DROP CONSTRAINT video_gallery_pkey;
ALTER TABLE ONLY public.usr_users DROP CONSTRAINT usr_users_id_pkey;
ALTER TABLE ONLY public.usr_profiles DROP CONSTRAINT usr_profiles_user_id_pkey;
ALTER TABLE ONLY public.usr_profiles_fields DROP CONSTRAINT usr_profiles_fields_id_pkey;
ALTER TABLE ONLY public."usr_AuthItem" DROP CONSTRAINT "usr_AuthItem_name_pkey";
ALTER TABLE ONLY public."usr_AuthItemChild" DROP CONSTRAINT "usr_AuthItemChild_parent_child_pkey";
ALTER TABLE ONLY public."usr_AuthAssignment" DROP CONSTRAINT "usr_AuthAssignment_itemname_userid_pkey";
ALTER TABLE ONLY public.url_manager DROP CONSTRAINT url_manager_pkey;
ALTER TABLE ONLY public.tbl_migration DROP CONSTRAINT tbl_migration_version_pkey;
ALTER TABLE ONLY public.static_page DROP CONSTRAINT static_page_id_pkey;
ALTER TABLE ONLY public.staff DROP CONSTRAINT staff_pkey;
ALTER TABLE ONLY public.sphinx DROP CONSTRAINT sphinx_pkey;
ALTER TABLE ONLY public.smi DROP CONSTRAINT smi_pkey;
ALTER TABLE ONLY public.settings_mail DROP CONSTRAINT settings_mail_id_pkey;
ALTER TABLE ONLY public.rating_project_file DROP CONSTRAINT rating_project_file_pkey;
ALTER TABLE ONLY public.rating_email DROP CONSTRAINT rating_email_pkey;
ALTER TABLE ONLY public.rating_doc DROP CONSTRAINT rating_doc_pkey;
ALTER TABLE ONLY public.public_report DROP CONSTRAINT public_report_pkey;
ALTER TABLE ONLY public.portal DROP CONSTRAINT portal_id_pkey;
ALTER TABLE ONLY public.portal_group DROP CONSTRAINT portal_group_pkey;
ALTER TABLE ONLY public.log DROP CONSTRAINT pk_id;
ALTER TABLE ONLY public.photo_gallery DROP CONSTRAINT photo_gallery_pkey;
ALTER TABLE ONLY public.photo_gallery_photos DROP CONSTRAINT photo_gallery_photos_pkey;
ALTER TABLE ONLY public.people_unit DROP CONSTRAINT people_unit_pkey;
ALTER TABLE ONLY public.people_staff DROP CONSTRAINT people_staff_pkey;
ALTER TABLE ONLY public.people DROP CONSTRAINT people_pkey;
ALTER TABLE ONLY public.page_seo DROP CONSTRAINT page_seo_pkey;
ALTER TABLE ONLY public.page_facts DROP CONSTRAINT page_facts_pkey;
ALTER TABLE ONLY public."pageExecutives" DROP CONSTRAINT "pageExecutives_pkey";
ALTER TABLE ONLY public.opendata_version DROP CONSTRAINT opendata_version_pkey;
ALTER TABLE ONLY public.opendata_settings DROP CONSTRAINT opendata_settings_pkey;
ALTER TABLE ONLY public.opendata DROP CONSTRAINT opendata_pkey;
ALTER TABLE ONLY public.news_type DROP CONSTRAINT news_type_id_pkey;
ALTER TABLE ONLY public.news_subscribers DROP CONSTRAINT news_subscribers_pkey;
ALTER TABLE ONLY public.news DROP CONSTRAINT news_id_pkey;
ALTER TABLE ONLY public.nav_menu DROP CONSTRAINT nav_menu_id_pkey;
ALTER TABLE ONLY public.nav_items DROP CONSTRAINT nav_items_id_pkey;
ALTER TABLE ONLY public.maps DROP CONSTRAINT maps_pkey;
ALTER TABLE ONLY public.mail_template DROP CONSTRAINT mail_template_pkey;
ALTER TABLE ONLY public.mail_subscribe DROP CONSTRAINT mail_subscribe_pkey;
ALTER TABLE ONLY public.mail_subscribe_files DROP CONSTRAINT mail_subscribe_files_pkey;
ALTER TABLE ONLY public.mail_group DROP CONSTRAINT mail_group_pkey;
ALTER TABLE ONLY public.mail_group_email_list DROP CONSTRAINT mail_group_email_list_pkey;
ALTER TABLE ONLY public.mail_email_list DROP CONSTRAINT mail_email_list_pkey;
ALTER TABLE ONLY public.links DROP CONSTRAINT links_id_pkey;
ALTER TABLE ONLY public.links_group DROP CONSTRAINT links_group_pkey;
ALTER TABLE ONLY public.independent_evaluation DROP CONSTRAINT independent_evaluation_pkey;
ALTER TABLE ONLY public.igov DROP CONSTRAINT igov_pkey;
ALTER TABLE ONLY public.ie_file DROP CONSTRAINT ie_file_pkey;
ALTER TABLE ONLY public.hotlines DROP CONSTRAINT hotlines_pkey;
ALTER TABLE ONLY public.gubernator DROP CONSTRAINT gubernator_pkey;
ALTER TABLE ONLY public.gubernator_info DROP CONSTRAINT gubernator_info_pkey;
ALTER TABLE ONLY public.folders_group DROP CONSTRAINT folders_group_pkey;
ALTER TABLE ONLY public.file DROP CONSTRAINT file_id_pkey;
ALTER TABLE ONLY public.feedback DROP CONSTRAINT feedback_pkey;
ALTER TABLE ONLY public.faqs DROP CONSTRAINT faqs_pkey;
ALTER TABLE ONLY public.experts_resources DROP CONSTRAINT experts_resources_pkey;
ALTER TABLE ONLY public.experts DROP CONSTRAINT experts_pkey;
ALTER TABLE ONLY public.executive DROP CONSTRAINT executive_pkey;
ALTER TABLE ONLY public.documents DROP CONSTRAINT documents_pkey;
ALTER TABLE ONLY public.document_folder DROP CONSTRAINT document_folder_pkey;
ALTER TABLE ONLY public.discuss DROP CONSTRAINT discuss_pkey;
ALTER TABLE ONLY public.counters DROP CONSTRAINT counters_pkey;
ALTER TABLE ONLY public.contest DROP CONSTRAINT contest_pkey;
ALTER TABLE ONLY public.contact DROP CONSTRAINT contact_pkey;
ALTER TABLE ONLY public.contact_details DROP CONSTRAINT contact_details_pkey;
ALTER TABLE ONLY public.committee_staff DROP CONSTRAINT committee_staff_pkey;
ALTER TABLE ONLY public.committee DROP CONSTRAINT committee_pkey;
ALTER TABLE ONLY public.committee_department DROP CONSTRAINT committee_department_pkey;
ALTER TABLE ONLY public.comments DROP CONSTRAINT comments_pkey;
ALTER TABLE ONLY public.category_post DROP CONSTRAINT category_post_pkey;
ALTER TABLE ONLY public.category_doc DROP CONSTRAINT category_doc_pkey;
ALTER TABLE ONLY public.audio DROP CONSTRAINT audio_pkey;
ALTER TABLE ONLY public.appeal_review DROP CONSTRAINT appeal_review_pkey;
ALTER TABLE ONLY public.appeal_place DROP CONSTRAINT appeal_place_pkey;
ALTER TABLE ONLY public.afisha DROP CONSTRAINT afisha_pkey;
ALTER TABLE ONLY public.afisha_conf DROP CONSTRAINT afisha_conf_pkey;
ALTER TABLE ONLY public.ac_schedule DROP CONSTRAINT ac_schedule_pkey;
ALTER TABLE ONLY public.ac_public DROP CONSTRAINT ac_public_pkey;
ALTER TABLE ONLY public.ac_members DROP CONSTRAINT ac_members_pkey;
ALTER TABLE ONLY public.ac_file DROP CONSTRAINT ac_file_pkey;
ALTER TABLE ONLY public.ac_expertise DROP CONSTRAINT ac_expertise_pkey;
ALTER TABLE ONLY public.ac_document DROP CONSTRAINT ac_document_pkey;
ALTER TABLE ONLY public.ac_commission DROP CONSTRAINT ac_commission_pkey;
ALTER TABLE ONLY public."YiiLog" DROP CONSTRAINT "YiiLog_id_pkey";
ALTER TABLE public.vote_user ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.vote_item ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.vote ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.video_gallery_videos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.video_gallery ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.url_manager ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.static_page ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.staff ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.sphinx ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.smi ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.rating_project_file ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.rating_email ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.rating_doc ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.public_report ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.portal_group ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.photo_gallery_photos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.photo_gallery ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.people_unit ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.people_staff ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.people ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.page_seo ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.page_facts ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public."pageExecutives" ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.opendata_version ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.opendata_settings ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.opendata ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.news_subscribers ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.maps ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.mail_template ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.mail_subscribe_files ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.mail_subscribe ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.mail_group_email_list ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.mail_group ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.mail_email_list ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.log ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.links_group ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.independent_evaluation ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.igov ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ie_file ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.hotlines ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.gubernator_info ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.gubernator ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.government_type ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.government ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.folders_group ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.feedback ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.faqs ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.experts_resources ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.experts ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.executive ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.documents ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.document_folder ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.discuss ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.counters ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.contest ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.contact_details ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.contact ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.committee_staff ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.committee_department ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.committee ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.comments ALTER COLUMN comment_id DROP DEFAULT;
ALTER TABLE public.category_post ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.category_doc ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.audio ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.appeal_schedule ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.appeal_review ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.appeal_place ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.afisha_conf ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.afisha ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ac_schedule ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ac_public ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ac_members ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ac_file ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ac_expertise ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ac_document ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ac_commission ALTER COLUMN id DROP DEFAULT;
DROP TABLE public.yiicache;
DROP SEQUENCE public.vote_user_id_seq;
DROP TABLE public.vote_user;
DROP SEQUENCE public.vote_item_id_seq;
DROP TABLE public.vote_item;
DROP SEQUENCE public.vote_id_seq;
DROP TABLE public.vote;
DROP SEQUENCE public.video_id_seq;
DROP TABLE public.video_gallery_videos;
DROP SEQUENCE public.video_gallery_id_seq;
DROP TABLE public.video_gallery;
DROP TABLE public.usr_users;
DROP SEQUENCE public.usr_users_id_seq;
DROP TABLE public.usr_profiles_fields;
DROP SEQUENCE public.usr_profiles_fields_id_seq;
DROP TABLE public.usr_profiles;
DROP SEQUENCE public.usr_profiles_user_id_seq;
DROP TABLE public."usr_AuthItemChild";
DROP TABLE public."usr_AuthItem";
DROP TABLE public."usr_AuthAssignment";
DROP SEQUENCE public.url_manager_id_seq;
DROP TABLE public.url_manager;
DROP TABLE public.tbl_migration;
DROP SEQUENCE public.static_page_id_seq;
DROP TABLE public.static_page;
DROP SEQUENCE public.staff_id_seq;
DROP TABLE public.staff;
DROP SEQUENCE public.sphinx_id_seq;
DROP TABLE public.sphinx;
DROP SEQUENCE public.smi_id_seq;
DROP TABLE public.smi;
DROP TABLE public.settings_mail;
DROP SEQUENCE public.settings_mail_id_seq;
DROP SEQUENCE public.reception_schedule_id_seq;
DROP SEQUENCE public.rating_project_file_id_seq;
DROP TABLE public.rating_project_file;
DROP SEQUENCE public.rating_email_id_seq;
DROP TABLE public.rating_email;
DROP SEQUENCE public.rating_doc_id_seq;
DROP TABLE public.rating_doc;
DROP SEQUENCE public.public_report_id_seq;
DROP TABLE public.public_report;
DROP SEQUENCE public.portal_group_id_seq;
DROP TABLE public.portal_group;
DROP TABLE public.portal;
DROP SEQUENCE public.portal_id_seq;
DROP SEQUENCE public.photo_gallery_photos_id_seq;
DROP TABLE public.photo_gallery_photos;
DROP SEQUENCE public.photo_gallery_id_seq;
DROP TABLE public.photo_gallery;
DROP SEQUENCE public.people_unit_id_seq;
DROP TABLE public.people_unit;
DROP SEQUENCE public.people_staff_id_seq;
DROP TABLE public.people_staff;
DROP SEQUENCE public.people_id_seq;
DROP TABLE public.people;
DROP SEQUENCE public.page_seo_id_seq;
DROP TABLE public.page_seo;
DROP SEQUENCE public.page_id_seq;
DROP SEQUENCE public.page_facts_id_seq;
DROP TABLE public.page_facts;
DROP SEQUENCE public."pageExecutives_id_seq";
DROP TABLE public."pageExecutives";
DROP SEQUENCE public.opendata_version_id_seq;
DROP TABLE public.opendata_version;
DROP SEQUENCE public.opendata_settings_id_seq;
DROP TABLE public.opendata_settings;
DROP SEQUENCE public.opendata_id_seq;
DROP TABLE public.opendata;
DROP TABLE public.news_type;
DROP SEQUENCE public.news_type_id_seq;
DROP SEQUENCE public.news_subscribers_id_seq;
DROP TABLE public.news_subscribers;
DROP TABLE public.news;
DROP SEQUENCE public.news_id_seq;
DROP TABLE public.nav_menu;
DROP SEQUENCE public.nav_menu_id_seq;
DROP TABLE public.nav_items;
DROP SEQUENCE public.nav_items_id_seq;
DROP SEQUENCE public.maps_id_seq;
DROP TABLE public.maps;
DROP SEQUENCE public.mail_template_id_seq;
DROP TABLE public.mail_template;
DROP SEQUENCE public.mail_subscribe_id_seq;
DROP SEQUENCE public.mail_subscribe_files_id_seq;
DROP TABLE public.mail_subscribe_files;
DROP TABLE public.mail_subscribe;
DROP SEQUENCE public.mail_group_id_seq;
DROP SEQUENCE public.mail_group_email_list_id_seq;
DROP TABLE public.mail_group_email_list;
DROP TABLE public.mail_group;
DROP SEQUENCE public.mail_email_list_id_seq;
DROP TABLE public.mail_email_list;
DROP SEQUENCE public.log_id_seq;
DROP TABLE public.log;
DROP SEQUENCE public.links_group_id_seq;
DROP TABLE public.links_group;
DROP TABLE public.links;
DROP SEQUENCE public.links_id_seq;
DROP SEQUENCE public.independent_evaluation_id_seq;
DROP TABLE public.independent_evaluation;
DROP SEQUENCE public.igov_id_seq;
DROP TABLE public.igov;
DROP SEQUENCE public.ie_file_id_seq;
DROP TABLE public.ie_file;
DROP SEQUENCE public.hotlines_id_seq;
DROP TABLE public.hotlines;
DROP SEQUENCE public.gubernator_info_id_seq;
DROP TABLE public.gubernator_info;
DROP SEQUENCE public.gubernator_id_seq;
DROP TABLE public.gubernator;
DROP SEQUENCE public.government_type_id_seq;
DROP TABLE public.government_type;
DROP SEQUENCE public.government_id_seq;
DROP TABLE public.government;
DROP SEQUENCE public.folders_group_id_seq;
DROP TABLE public.folders_group;
DROP TABLE public.file;
DROP SEQUENCE public.file_id_seq;
DROP SEQUENCE public.feedback_id_seq;
DROP TABLE public.feedback;
DROP SEQUENCE public.faqs_id_seq;
DROP TABLE public.faqs;
DROP SEQUENCE public.experts_resources_id_seq;
DROP TABLE public.experts_resources;
DROP SEQUENCE public.experts_id_seq;
DROP TABLE public.experts;
DROP SEQUENCE public.executive_id_seq;
DROP TABLE public.executive;
DROP SEQUENCE public.documents_id_seq;
DROP TABLE public.documents;
DROP SEQUENCE public.document_folder_id_seq;
DROP TABLE public.document_folder;
DROP SEQUENCE public.discuss_id_seq;
DROP TABLE public.discuss;
DROP SEQUENCE public.counters_id_seq;
DROP TABLE public.counters;
DROP SEQUENCE public.contest_id_seq;
DROP TABLE public.contest;
DROP SEQUENCE public.contact_id_seq;
DROP SEQUENCE public.contact_details_id_seq;
DROP TABLE public.contact_details;
DROP TABLE public.contact;
DROP SEQUENCE public.committee_staff_id_seq;
DROP TABLE public.committee_staff;
DROP SEQUENCE public.committee_id_seq;
DROP SEQUENCE public.committee_department_id_seq;
DROP TABLE public.committee_department;
DROP TABLE public.committee;
DROP SEQUENCE public.comments_comment_id_seq;
DROP TABLE public.comments;
DROP SEQUENCE public.category_post_id_seq;
DROP TABLE public.category_post;
DROP SEQUENCE public.category_doc_id_seq;
DROP TABLE public.category_doc;
DROP SEQUENCE public.audio_id_seq;
DROP TABLE public.audio;
DROP TABLE public.appeal_schedule;
DROP SEQUENCE public.appeal_review_id_seq;
DROP TABLE public.appeal_review;
DROP SEQUENCE public.appeal_place_id_seq;
DROP TABLE public.appeal_place;
DROP SEQUENCE public.afisha_id_seq;
DROP SEQUENCE public.afisha_conf_id_seq;
DROP TABLE public.afisha_conf;
DROP TABLE public.afisha;
DROP SEQUENCE public.ac_schedule_id_seq;
DROP TABLE public.ac_schedule;
DROP SEQUENCE public.ac_public_id_seq;
DROP TABLE public.ac_public;
DROP SEQUENCE public.ac_members_id_seq;
DROP TABLE public.ac_members;
DROP SEQUENCE public.ac_file_id_seq;
DROP TABLE public.ac_file;
DROP SEQUENCE public.ac_expertise_id_seq;
DROP TABLE public.ac_expertise;
DROP SEQUENCE public.ac_document_id_seq;
DROP TABLE public.ac_document;
DROP SEQUENCE public.ac_commission_id_seq;
DROP TABLE public.ac_commission;
DROP TABLE public."YiiLog";
DROP SEQUENCE public.yiilog_id_seq;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET search_path = public, pg_catalog;

--
-- Name: yiilog_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE yiilog_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.yiilog_id_seq OWNER TO postgres;

--
-- Name: yiilog_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('yiilog_id_seq', 42112, true);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: YiiLog; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "YiiLog" (
    id integer DEFAULT nextval('yiilog_id_seq'::regclass) NOT NULL,
    level character varying(128),
    category character varying(128),
    logtime integer,
    message text
);


ALTER TABLE public."YiiLog" OWNER TO postgres;

--
-- Name: ac_commission; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ac_commission (
    id integer NOT NULL,
    portal_id integer,
    decree text,
    regulation text
);


ALTER TABLE public.ac_commission OWNER TO postgres;

--
-- Name: ac_commission_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ac_commission_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ac_commission_id_seq OWNER TO postgres;

--
-- Name: ac_commission_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ac_commission_id_seq OWNED BY ac_commission.id;


--
-- Name: ac_commission_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ac_commission_id_seq', 1, false);


--
-- Name: ac_document; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ac_document (
    id integer NOT NULL,
    portal_id integer,
    title character varying(500),
    file integer,
    type_id integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.ac_document OWNER TO postgres;

--
-- Name: ac_document_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ac_document_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ac_document_id_seq OWNER TO postgres;

--
-- Name: ac_document_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ac_document_id_seq OWNED BY ac_document.id;


--
-- Name: ac_document_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ac_document_id_seq', 1, true);


--
-- Name: ac_expertise; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ac_expertise (
    id integer NOT NULL,
    portal_id integer,
    title character varying(500),
    file integer,
    date_start integer,
    date_finish integer,
    date_publish integer,
    executive_id integer,
    description text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.ac_expertise OWNER TO postgres;

--
-- Name: ac_expertise_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ac_expertise_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ac_expertise_id_seq OWNER TO postgres;

--
-- Name: ac_expertise_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ac_expertise_id_seq OWNED BY ac_expertise.id;


--
-- Name: ac_expertise_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ac_expertise_id_seq', 1, false);


--
-- Name: ac_file; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ac_file (
    id integer NOT NULL,
    title character varying(500),
    file integer,
    type integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.ac_file OWNER TO postgres;

--
-- Name: ac_file_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ac_file_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ac_file_id_seq OWNER TO postgres;

--
-- Name: ac_file_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ac_file_id_seq OWNED BY ac_file.id;


--
-- Name: ac_file_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ac_file_id_seq', 1, false);


--
-- Name: ac_members; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ac_members (
    id integer NOT NULL,
    portal_id integer,
    fio character varying(255),
    post character varying(500),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.ac_members OWNER TO postgres;

--
-- Name: ac_members_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ac_members_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ac_members_id_seq OWNER TO postgres;

--
-- Name: ac_members_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ac_members_id_seq OWNED BY ac_members.id;


--
-- Name: ac_members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ac_members_id_seq', 1, false);


--
-- Name: ac_public; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ac_public (
    id integer NOT NULL,
    portal_id integer,
    post_type_id integer,
    fio character varying(255),
    post character varying(500),
    file integer,
    year integer,
    type integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.ac_public OWNER TO postgres;

--
-- Name: ac_public_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ac_public_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ac_public_id_seq OWNER TO postgres;

--
-- Name: ac_public_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ac_public_id_seq OWNED BY ac_public.id;


--
-- Name: ac_public_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ac_public_id_seq', 1, false);


--
-- Name: ac_schedule; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ac_schedule (
    id integer NOT NULL,
    portal_id integer,
    date integer,
    description text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.ac_schedule OWNER TO postgres;

--
-- Name: ac_schedule_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ac_schedule_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ac_schedule_id_seq OWNER TO postgres;

--
-- Name: ac_schedule_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ac_schedule_id_seq OWNED BY ac_schedule.id;


--
-- Name: ac_schedule_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ac_schedule_id_seq', 1, false);


--
-- Name: afisha; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE afisha (
    id integer NOT NULL,
    portal_id integer NOT NULL,
    title character varying(255) NOT NULL,
    place text,
    duration integer,
    photo integer,
    date integer,
    state integer,
    state_date integer,
    preview text,
    description text,
    organizer character varying(255),
    longitude character varying(255),
    latitude character varying(255),
    participant character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.afisha OWNER TO postgres;

--
-- Name: afisha_conf; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE afisha_conf (
    id integer NOT NULL,
    portal_id integer,
    month_file integer,
    quarter_file integer,
    year_file integer
);


ALTER TABLE public.afisha_conf OWNER TO postgres;

--
-- Name: afisha_conf_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE afisha_conf_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.afisha_conf_id_seq OWNER TO postgres;

--
-- Name: afisha_conf_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE afisha_conf_id_seq OWNED BY afisha_conf.id;


--
-- Name: afisha_conf_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('afisha_conf_id_seq', 1, false);


--
-- Name: afisha_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE afisha_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.afisha_id_seq OWNER TO postgres;

--
-- Name: afisha_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE afisha_id_seq OWNED BY afisha.id;


--
-- Name: afisha_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('afisha_id_seq', 6, true);


--
-- Name: appeal_place; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE appeal_place (
    id integer NOT NULL,
    portal_id integer,
    department character varying(500),
    address character varying(500),
    "time" character varying(500),
    head character varying(100),
    phone character varying(100),
    email character varying(100),
    description text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.appeal_place OWNER TO postgres;

--
-- Name: appeal_place_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE appeal_place_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.appeal_place_id_seq OWNER TO postgres;

--
-- Name: appeal_place_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE appeal_place_id_seq OWNED BY appeal_place.id;


--
-- Name: appeal_place_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('appeal_place_id_seq', 1, true);


--
-- Name: appeal_review; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE appeal_review (
    id integer NOT NULL,
    portal_id integer,
    file_id integer,
    year character varying(100),
    description text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.appeal_review OWNER TO postgres;

--
-- Name: appeal_review_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE appeal_review_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.appeal_review_id_seq OWNER TO postgres;

--
-- Name: appeal_review_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE appeal_review_id_seq OWNED BY appeal_review.id;


--
-- Name: appeal_review_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('appeal_review_id_seq', 4, true);


--
-- Name: appeal_schedule; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE appeal_schedule (
    id integer NOT NULL,
    job_title character varying(500),
    name character varying(255),
    date integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.appeal_schedule OWNER TO postgres;

--
-- Name: audio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE audio (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    wav integer,
    mp3 integer,
    portal_id integer NOT NULL,
    file integer NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.audio OWNER TO postgres;

--
-- Name: audio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE audio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.audio_id_seq OWNER TO postgres;

--
-- Name: audio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE audio_id_seq OWNED BY audio.id;


--
-- Name: audio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('audio_id_seq', 3, true);


--
-- Name: category_doc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE category_doc (
    id integer NOT NULL,
    name character varying(500) NOT NULL
);


ALTER TABLE public.category_doc OWNER TO postgres;

--
-- Name: category_doc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE category_doc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.category_doc_id_seq OWNER TO postgres;

--
-- Name: category_doc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE category_doc_id_seq OWNED BY category_doc.id;


--
-- Name: category_doc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('category_doc_id_seq', 14, true);


--
-- Name: category_post; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE category_post (
    id integer NOT NULL,
    name character varying(500),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.category_post OWNER TO postgres;

--
-- Name: category_post_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE category_post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.category_post_id_seq OWNER TO postgres;

--
-- Name: category_post_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE category_post_id_seq OWNED BY category_post.id;


--
-- Name: category_post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('category_post_id_seq', 6, true);


--
-- Name: comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE comments (
    owner_name character varying(50),
    owner_id integer,
    comment_id integer NOT NULL,
    parent_comment_id integer,
    creator_id integer,
    user_name character varying(255),
    user_email character varying(255),
    comment_text text,
    create_time integer,
    update_time integer,
    status integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.comments OWNER TO postgres;

--
-- Name: comments_comment_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE comments_comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.comments_comment_id_seq OWNER TO postgres;

--
-- Name: comments_comment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE comments_comment_id_seq OWNED BY comments.comment_id;


--
-- Name: comments_comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comments_comment_id_seq', 1, false);


--
-- Name: committee; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE committee (
    id integer NOT NULL,
    portal_id integer,
    name text,
    description text
);


ALTER TABLE public.committee OWNER TO postgres;

--
-- Name: committee_department; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE committee_department (
    id integer NOT NULL,
    committee_id integer,
    name text,
    description text
);


ALTER TABLE public.committee_department OWNER TO postgres;

--
-- Name: committee_department_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE committee_department_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.committee_department_id_seq OWNER TO postgres;

--
-- Name: committee_department_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE committee_department_id_seq OWNED BY committee_department.id;


--
-- Name: committee_department_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('committee_department_id_seq', 1, false);


--
-- Name: committee_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE committee_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.committee_id_seq OWNER TO postgres;

--
-- Name: committee_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE committee_id_seq OWNED BY committee.id;


--
-- Name: committee_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('committee_id_seq', 1, false);


--
-- Name: committee_staff; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE committee_staff (
    id integer NOT NULL,
    department_id integer,
    photo integer,
    full_name character varying(255),
    contact_address character varying(255),
    contact_phone character varying(255),
    contact_fax character varying(255),
    contact_site character varying(255),
    contact_email character varying(255),
    main_info text,
    life text,
    social_vk character varying(255),
    social_tw character varying(255),
    social_fb character varying(255)
);


ALTER TABLE public.committee_staff OWNER TO postgres;

--
-- Name: committee_staff_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE committee_staff_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.committee_staff_id_seq OWNER TO postgres;

--
-- Name: committee_staff_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE committee_staff_id_seq OWNED BY committee_staff.id;


--
-- Name: committee_staff_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('committee_staff_id_seq', 1, false);


--
-- Name: contact; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE contact (
    id integer NOT NULL,
    portal_id integer,
    title character varying(500),
    alias character varying(100),
    address character varying(500),
    photo integer,
    driving_directions text,
    description text,
    executive_id integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.contact OWNER TO postgres;

--
-- Name: contact_details; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE contact_details (
    id integer NOT NULL,
    contact_id integer,
    type integer,
    value character varying(100),
    description text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.contact_details OWNER TO postgres;

--
-- Name: contact_details_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE contact_details_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.contact_details_id_seq OWNER TO postgres;

--
-- Name: contact_details_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE contact_details_id_seq OWNED BY contact_details.id;


--
-- Name: contact_details_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('contact_details_id_seq', 6, true);


--
-- Name: contact_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE contact_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.contact_id_seq OWNER TO postgres;

--
-- Name: contact_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE contact_id_seq OWNED BY contact.id;


--
-- Name: contact_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('contact_id_seq', 1, true);


--
-- Name: contest; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE contest (
    id integer NOT NULL,
    org character varying(500) NOT NULL,
    title character varying(500) NOT NULL,
    description_small character varying(1000),
    description text,
    date_start integer,
    date_end integer,
    date_placed integer,
    file integer,
    state integer DEFAULT 0 NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.contest OWNER TO postgres;

--
-- Name: contest_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE contest_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.contest_id_seq OWNER TO postgres;

--
-- Name: contest_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE contest_id_seq OWNED BY contest.id;


--
-- Name: contest_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('contest_id_seq', 2, true);


--
-- Name: counters; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE counters (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    code text,
    portal_id integer DEFAULT 1
);


ALTER TABLE public.counters OWNER TO postgres;

--
-- Name: counters_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE counters_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.counters_id_seq OWNER TO postgres;

--
-- Name: counters_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE counters_id_seq OWNED BY counters.id;


--
-- Name: counters_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('counters_id_seq', 1, true);


--
-- Name: discuss; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE discuss (
    id integer NOT NULL,
    portal_id integer,
    title character varying(255),
    date_start integer,
    date_finish integer,
    date_publish integer,
    description text,
    file integer,
    executive_id integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.discuss OWNER TO postgres;

--
-- Name: discuss_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE discuss_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.discuss_id_seq OWNER TO postgres;

--
-- Name: discuss_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE discuss_id_seq OWNED BY discuss.id;


--
-- Name: discuss_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('discuss_id_seq', 1, false);


--
-- Name: document_folder; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE document_folder (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    photo integer,
    ordi integer,
    state integer,
    parent_id integer DEFAULT 0,
    group_id integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.document_folder OWNER TO postgres;

--
-- Name: document_folder_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE document_folder_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.document_folder_id_seq OWNER TO postgres;

--
-- Name: document_folder_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE document_folder_id_seq OWNED BY document_folder.id;


--
-- Name: document_folder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('document_folder_id_seq', 111, true);


--
-- Name: documents; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE documents (
    id bigint NOT NULL,
    folder_id integer NOT NULL,
    title character varying(255) NOT NULL,
    file integer NOT NULL,
    preview text,
    ordi integer,
    date integer,
    number character varying(255),
    note character varying(500),
    public character varying(500),
    pdf integer,
    doc integer,
    zip integer,
    change_date integer,
    description text,
    executive_id integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.documents OWNER TO postgres;

--
-- Name: documents_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE documents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.documents_id_seq OWNER TO postgres;

--
-- Name: documents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE documents_id_seq OWNED BY documents.id;


--
-- Name: documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('documents_id_seq', 255, true);


--
-- Name: executive; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE executive (
    id integer NOT NULL,
    name character varying(500),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.executive OWNER TO postgres;

--
-- Name: executive_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE executive_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.executive_id_seq OWNER TO postgres;

--
-- Name: executive_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE executive_id_seq OWNED BY executive.id;


--
-- Name: executive_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('executive_id_seq', 55, true);


--
-- Name: experts; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE experts (
    id integer NOT NULL,
    portal_id integer,
    type integer,
    fio character varying(255),
    phone character varying(255),
    email character varying(255),
    contact_address character varying(255),
    skills character varying(255),
    education character varying(255),
    scientific character varying(255),
    profession_skill text,
    history text,
    sovet_id integer,
    experience text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.experts OWNER TO postgres;

--
-- Name: COLUMN experts.portal_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.portal_id IS 'Портал';


--
-- Name: COLUMN experts.type; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.type IS 'Тип';


--
-- Name: COLUMN experts.fio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.fio IS 'ФИО';


--
-- Name: COLUMN experts.phone; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.phone IS 'Контактный телефон';


--
-- Name: COLUMN experts.email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.email IS 'Адрес электронной почты';


--
-- Name: COLUMN experts.contact_address; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.contact_address IS 'Место проживания, контактная информация';


--
-- Name: COLUMN experts.skills; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.skills IS 'Сферы профессиональных интересов';


--
-- Name: COLUMN experts.education; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.education IS 'Наличие ученой степени';


--
-- Name: COLUMN experts.scientific; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.scientific IS 'Образование';


--
-- Name: COLUMN experts.profession_skill; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.profession_skill IS 'Ключевые профессиональные компетенции';


--
-- Name: COLUMN experts.history; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts.history IS 'Историю участия в экспертных проектах';


--
-- Name: experts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE experts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.experts_id_seq OWNER TO postgres;

--
-- Name: experts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE experts_id_seq OWNED BY experts.id;


--
-- Name: experts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('experts_id_seq', 6, true);


--
-- Name: experts_resources; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE experts_resources (
    id integer NOT NULL,
    experts_id integer,
    type smallint,
    url character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.experts_resources OWNER TO postgres;

--
-- Name: COLUMN experts_resources.experts_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts_resources.experts_id IS 'Expert';


--
-- Name: COLUMN experts_resources.type; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts_resources.type IS 'Тип';


--
-- Name: COLUMN experts_resources.url; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN experts_resources.url IS 'URL';


--
-- Name: experts_resources_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE experts_resources_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.experts_resources_id_seq OWNER TO postgres;

--
-- Name: experts_resources_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE experts_resources_id_seq OWNED BY experts_resources.id;


--
-- Name: experts_resources_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('experts_resources_id_seq', 6, true);


--
-- Name: faqs; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE faqs (
    id integer NOT NULL,
    question text NOT NULL,
    answer text NOT NULL,
    ordi integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.faqs OWNER TO postgres;

--
-- Name: faqs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE faqs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.faqs_id_seq OWNER TO postgres;

--
-- Name: faqs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE faqs_id_seq OWNED BY faqs.id;


--
-- Name: faqs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('faqs_id_seq', 2, true);


--
-- Name: feedback; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE feedback (
    id bigint NOT NULL,
    type integer NOT NULL,
    fio character varying(255) NOT NULL,
    phone character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    text text NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL,
    portal_id integer DEFAULT 1
);


ALTER TABLE public.feedback OWNER TO postgres;

--
-- Name: feedback_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE feedback_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.feedback_id_seq OWNER TO postgres;

--
-- Name: feedback_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE feedback_id_seq OWNED BY feedback.id;


--
-- Name: feedback_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feedback_id_seq', 4, true);


--
-- Name: file_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE file_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.file_id_seq OWNER TO postgres;

--
-- Name: file_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('file_id_seq', 1764, true);


--
-- Name: file; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE file (
    id integer DEFAULT nextval('file_id_seq'::regclass) NOT NULL,
    portal_id integer NOT NULL,
    origin_name character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    size integer NOT NULL,
    ext character varying(10) NOT NULL,
    date integer NOT NULL,
    user_id integer
);


ALTER TABLE public.file OWNER TO postgres;

--
-- Name: folders_group; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE folders_group (
    id integer NOT NULL,
    alias character varying(255),
    name character varying(255),
    portal_id integer DEFAULT 1,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.folders_group OWNER TO postgres;

--
-- Name: folders_group_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE folders_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.folders_group_id_seq OWNER TO postgres;

--
-- Name: folders_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE folders_group_id_seq OWNED BY folders_group.id;


--
-- Name: folders_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('folders_group_id_seq', 1818, true);


--
-- Name: government; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE government (
    id integer NOT NULL,
    parent_id integer,
    name character varying NOT NULL,
    url character varying NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.government OWNER TO postgres;

--
-- Name: government_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE government_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.government_id_seq OWNER TO postgres;

--
-- Name: government_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE government_id_seq OWNED BY government.id;


--
-- Name: government_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('government_id_seq', 1, false);


--
-- Name: government_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE government_type (
    id integer NOT NULL,
    parent_id integer,
    name character varying,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.government_type OWNER TO postgres;

--
-- Name: government_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE government_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.government_type_id_seq OWNER TO postgres;

--
-- Name: government_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE government_type_id_seq OWNED BY government_type.id;


--
-- Name: government_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('government_type_id_seq', 1, false);


--
-- Name: gubernator; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE gubernator (
    id integer NOT NULL,
    title character varying(255),
    state integer,
    url character varying(500),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.gubernator OWNER TO postgres;

--
-- Name: gubernator_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE gubernator_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.gubernator_id_seq OWNER TO postgres;

--
-- Name: gubernator_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE gubernator_id_seq OWNED BY gubernator.id;


--
-- Name: gubernator_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('gubernator_id_seq', 5, true);


--
-- Name: gubernator_info; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE gubernator_info (
    id integer NOT NULL,
    fio character varying(255),
    photo integer,
    type character varying(255)
);


ALTER TABLE public.gubernator_info OWNER TO postgres;

--
-- Name: gubernator_info_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE gubernator_info_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.gubernator_info_id_seq OWNER TO postgres;

--
-- Name: gubernator_info_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE gubernator_info_id_seq OWNED BY gubernator_info.id;


--
-- Name: gubernator_info_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('gubernator_info_id_seq', 1, true);


--
-- Name: hotlines; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE hotlines (
    id integer NOT NULL,
    name character varying(255),
    phone character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.hotlines OWNER TO postgres;

--
-- Name: hotlines_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE hotlines_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.hotlines_id_seq OWNER TO postgres;

--
-- Name: hotlines_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE hotlines_id_seq OWNED BY hotlines.id;


--
-- Name: hotlines_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('hotlines_id_seq', 4, true);


--
-- Name: ie_file; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ie_file (
    id integer NOT NULL,
    title character varying(500),
    description text,
    file integer,
    file_type integer,
    date integer,
    doc_type integer
);


ALTER TABLE public.ie_file OWNER TO postgres;

--
-- Name: ie_file_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ie_file_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ie_file_id_seq OWNER TO postgres;

--
-- Name: ie_file_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ie_file_id_seq OWNED BY ie_file.id;


--
-- Name: ie_file_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ie_file_id_seq', 1, false);


--
-- Name: igov; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE igov (
    id integer NOT NULL,
    type integer,
    name character varying(255)
);


ALTER TABLE public.igov OWNER TO postgres;

--
-- Name: COLUMN igov.type; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN igov.type IS 'Тип';


--
-- Name: COLUMN igov.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN igov.name IS 'Название';


--
-- Name: igov_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE igov_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.igov_id_seq OWNER TO postgres;

--
-- Name: igov_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE igov_id_seq OWNED BY igov.id;


--
-- Name: igov_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('igov_id_seq', 56, true);


--
-- Name: independent_evaluation; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE independent_evaluation (
    id integer NOT NULL,
    link character varying(500),
    portal_group_id integer,
    executive_id integer
);


ALTER TABLE public.independent_evaluation OWNER TO postgres;

--
-- Name: independent_evaluation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE independent_evaluation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.independent_evaluation_id_seq OWNER TO postgres;

--
-- Name: independent_evaluation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE independent_evaluation_id_seq OWNED BY independent_evaluation.id;


--
-- Name: independent_evaluation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('independent_evaluation_id_seq', 1, false);


--
-- Name: links_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE links_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.links_id_seq OWNER TO postgres;

--
-- Name: links_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('links_id_seq', 111, true);


--
-- Name: links; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE links (
    id integer DEFAULT nextval('links_id_seq'::regclass) NOT NULL,
    title character varying(255) NOT NULL,
    url character varying(500) NOT NULL,
    photo integer NOT NULL,
    ordi integer,
    group_id integer
);


ALTER TABLE public.links OWNER TO postgres;

--
-- Name: links_group; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE links_group (
    id integer NOT NULL,
    portal_id integer DEFAULT 1 NOT NULL,
    alias character varying(255) DEFAULT NULL::character varying,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.links_group OWNER TO postgres;

--
-- Name: links_group_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE links_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.links_group_id_seq OWNER TO postgres;

--
-- Name: links_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE links_group_id_seq OWNED BY links_group.id;


--
-- Name: links_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('links_group_id_seq', 1816, true);


--
-- Name: log; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE log (
    id integer NOT NULL,
    "changedModel" character varying(50),
    "typeOfChange" character varying(50),
    "userId" integer,
    date integer,
    portal_id integer DEFAULT 1
);


ALTER TABLE public.log OWNER TO postgres;

--
-- Name: log_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE log_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.log_id_seq OWNER TO postgres;

--
-- Name: log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE log_id_seq OWNED BY log.id;


--
-- Name: log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('log_id_seq', 93443, true);


--
-- Name: mail_email_list; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mail_email_list (
    id integer NOT NULL,
    email character varying(255),
    first_name character varying(255),
    last_name character varying(255),
    surname character varying(255),
    agreement smallint DEFAULT 0,
    is_alert smallint DEFAULT 0,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.mail_email_list OWNER TO postgres;

--
-- Name: COLUMN mail_email_list.email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_email_list.email IS 'E-mail';


--
-- Name: COLUMN mail_email_list.first_name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_email_list.first_name IS 'Имя';


--
-- Name: COLUMN mail_email_list.last_name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_email_list.last_name IS 'Фамилия';


--
-- Name: COLUMN mail_email_list.surname; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_email_list.surname IS 'Отчество';


--
-- Name: COLUMN mail_email_list.agreement; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_email_list.agreement IS 'Согласие';


--
-- Name: mail_email_list_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mail_email_list_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mail_email_list_id_seq OWNER TO postgres;

--
-- Name: mail_email_list_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mail_email_list_id_seq OWNED BY mail_email_list.id;


--
-- Name: mail_email_list_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mail_email_list_id_seq', 179, true);


--
-- Name: mail_group; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mail_group (
    id integer NOT NULL,
    name character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.mail_group OWNER TO postgres;

--
-- Name: COLUMN mail_group.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_group.name IS 'Название';


--
-- Name: mail_group_email_list; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mail_group_email_list (
    id integer NOT NULL,
    list_id integer,
    group_id integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.mail_group_email_list OWNER TO postgres;

--
-- Name: COLUMN mail_group_email_list.list_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_group_email_list.list_id IS 'E-mail';


--
-- Name: COLUMN mail_group_email_list.group_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_group_email_list.group_id IS 'Группа';


--
-- Name: mail_group_email_list_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mail_group_email_list_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mail_group_email_list_id_seq OWNER TO postgres;

--
-- Name: mail_group_email_list_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mail_group_email_list_id_seq OWNED BY mail_group_email_list.id;


--
-- Name: mail_group_email_list_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mail_group_email_list_id_seq', 191, true);


--
-- Name: mail_group_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mail_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mail_group_id_seq OWNER TO postgres;

--
-- Name: mail_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mail_group_id_seq OWNED BY mail_group.id;


--
-- Name: mail_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mail_group_id_seq', 5, true);


--
-- Name: mail_subscribe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mail_subscribe (
    id integer NOT NULL,
    group_id integer,
    template_id integer,
    sender_email character varying(255),
    date integer DEFAULT 0,
    is_send smallint DEFAULT 0,
    name character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.mail_subscribe OWNER TO postgres;

--
-- Name: COLUMN mail_subscribe.group_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_subscribe.group_id IS 'Группа';


--
-- Name: COLUMN mail_subscribe.template_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_subscribe.template_id IS 'Шаблон';


--
-- Name: COLUMN mail_subscribe.sender_email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_subscribe.sender_email IS 'Адреса отправителя';


--
-- Name: COLUMN mail_subscribe.date; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_subscribe.date IS 'Дата';


--
-- Name: COLUMN mail_subscribe.is_send; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_subscribe.is_send IS 'Отправлено';


--
-- Name: COLUMN mail_subscribe.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_subscribe.name IS 'Название рассылки';


--
-- Name: mail_subscribe_files; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mail_subscribe_files (
    id integer NOT NULL,
    subscribe_id integer,
    photo integer DEFAULT 0,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.mail_subscribe_files OWNER TO postgres;

--
-- Name: COLUMN mail_subscribe_files.subscribe_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_subscribe_files.subscribe_id IS 'Рассылка';


--
-- Name: COLUMN mail_subscribe_files.photo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_subscribe_files.photo IS 'Файл';


--
-- Name: mail_subscribe_files_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mail_subscribe_files_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mail_subscribe_files_id_seq OWNER TO postgres;

--
-- Name: mail_subscribe_files_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mail_subscribe_files_id_seq OWNED BY mail_subscribe_files.id;


--
-- Name: mail_subscribe_files_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mail_subscribe_files_id_seq', 6, true);


--
-- Name: mail_subscribe_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mail_subscribe_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mail_subscribe_id_seq OWNER TO postgres;

--
-- Name: mail_subscribe_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mail_subscribe_id_seq OWNED BY mail_subscribe.id;


--
-- Name: mail_subscribe_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mail_subscribe_id_seq', 3, true);


--
-- Name: mail_template; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mail_template (
    id integer NOT NULL,
    name character varying(255),
    content text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.mail_template OWNER TO postgres;

--
-- Name: COLUMN mail_template.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_template.name IS 'Название';


--
-- Name: COLUMN mail_template.content; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN mail_template.content IS 'Контент';


--
-- Name: mail_template_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mail_template_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mail_template_id_seq OWNER TO postgres;

--
-- Name: mail_template_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mail_template_id_seq OWNED BY mail_template.id;


--
-- Name: mail_template_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mail_template_id_seq', 4, true);


--
-- Name: maps; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE maps (
    id integer NOT NULL,
    name character varying(255),
    head character varying(255),
    area character varying(50),
    people character varying(50),
    site character varying(255),
    path text,
    pos_x integer,
    pos_y integer,
    is_city integer,
    "order" integer
);


ALTER TABLE public.maps OWNER TO postgres;

--
-- Name: maps_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE maps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.maps_id_seq OWNER TO postgres;

--
-- Name: maps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE maps_id_seq OWNED BY maps.id;


--
-- Name: maps_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('maps_id_seq', 20, true);


--
-- Name: nav_items_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE nav_items_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.nav_items_id_seq OWNER TO postgres;

--
-- Name: nav_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('nav_items_id_seq', 3850, true);


--
-- Name: nav_items; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE nav_items (
    id integer DEFAULT nextval('nav_items_id_seq'::regclass) NOT NULL,
    title character varying(255) NOT NULL,
    parent_id integer DEFAULT 0,
    ordi integer,
    state integer DEFAULT 0,
    "menuId" integer NOT NULL,
    photo character varying(255),
    url_id integer,
    is_deleted integer DEFAULT 0 NOT NULL,
    is_link integer DEFAULT 1
);


ALTER TABLE public.nav_items OWNER TO postgres;

--
-- Name: nav_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE nav_menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.nav_menu_id_seq OWNER TO postgres;

--
-- Name: nav_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('nav_menu_id_seq', 94, true);


--
-- Name: nav_menu; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE nav_menu (
    id integer DEFAULT nextval('nav_menu_id_seq'::regclass) NOT NULL,
    name character varying(255) NOT NULL,
    portal_id integer DEFAULT 1,
    alias character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.nav_menu OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.news_id_seq OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('news_id_seq', 37, true);


--
-- Name: news; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE news (
    id integer DEFAULT nextval('news_id_seq'::regclass) NOT NULL,
    portal_id integer NOT NULL,
    author character varying(255),
    date integer,
    photo character varying(255),
    title character varying(255) NOT NULL,
    preview text,
    description text,
    state integer DEFAULT 0,
    type integer DEFAULT 0,
    photo_title character varying(255),
    url_id integer,
    social integer DEFAULT 1,
    modify integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.news OWNER TO postgres;

--
-- Name: news_subscribers; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE news_subscribers (
    id integer NOT NULL,
    portal_id integer,
    subscriber character varying(500),
    email character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.news_subscribers OWNER TO postgres;

--
-- Name: news_subscribers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE news_subscribers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.news_subscribers_id_seq OWNER TO postgres;

--
-- Name: news_subscribers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE news_subscribers_id_seq OWNED BY news_subscribers.id;


--
-- Name: news_subscribers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('news_subscribers_id_seq', 1, true);


--
-- Name: news_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE news_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.news_type_id_seq OWNER TO postgres;

--
-- Name: news_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('news_type_id_seq', 1766, true);


--
-- Name: news_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE news_type (
    id integer DEFAULT nextval('news_type_id_seq'::regclass) NOT NULL,
    alias character varying(100),
    title text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.news_type OWNER TO postgres;

--
-- Name: opendata; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE opendata (
    id bigint NOT NULL,
    identifier character varying(255),
    title character varying(255),
    description text,
    owner character varying(255),
    responsible character varying(255),
    phone character varying(255),
    email character varying(255),
    link character varying(255),
    format character varying(255),
    structure text,
    date_init integer,
    date_last_change integer,
    last_content integer,
    date_actual integer,
    link_version character varying(255),
    keyword text,
    link_version_struct character varying(255),
    version character varying(255),
    portal_id integer NOT NULL,
    category integer NOT NULL,
    file integer NOT NULL,
    period character varying(255),
    structure_file integer,
    view_count integer DEFAULT 0,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.opendata OWNER TO postgres;

--
-- Name: opendata_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE opendata_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.opendata_id_seq OWNER TO postgres;

--
-- Name: opendata_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE opendata_id_seq OWNED BY opendata.id;


--
-- Name: opendata_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('opendata_id_seq', 3, true);


--
-- Name: opendata_settings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE opendata_settings (
    id integer NOT NULL,
    file integer
);


ALTER TABLE public.opendata_settings OWNER TO postgres;

--
-- Name: opendata_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE opendata_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.opendata_settings_id_seq OWNER TO postgres;

--
-- Name: opendata_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE opendata_settings_id_seq OWNED BY opendata_settings.id;


--
-- Name: opendata_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('opendata_settings_id_seq', 1, false);


--
-- Name: opendata_version; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE opendata_version (
    id integer NOT NULL,
    opendata_id integer,
    file integer,
    date integer NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.opendata_version OWNER TO postgres;

--
-- Name: opendata_version_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE opendata_version_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.opendata_version_id_seq OWNER TO postgres;

--
-- Name: opendata_version_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE opendata_version_id_seq OWNED BY opendata_version.id;


--
-- Name: opendata_version_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('opendata_version_id_seq', 1, false);


--
-- Name: pageExecutives; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "pageExecutives" (
    id integer NOT NULL,
    page_id integer NOT NULL,
    executive_id integer NOT NULL,
    url character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public."pageExecutives" OWNER TO postgres;

--
-- Name: pageExecutives_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "pageExecutives_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public."pageExecutives_id_seq" OWNER TO postgres;

--
-- Name: pageExecutives_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "pageExecutives_id_seq" OWNED BY "pageExecutives".id;


--
-- Name: pageExecutives_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"pageExecutives_id_seq"', 41, true);


--
-- Name: page_facts; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE page_facts (
    id integer NOT NULL,
    page_id integer,
    text text,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.page_facts OWNER TO postgres;

--
-- Name: page_facts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE page_facts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.page_facts_id_seq OWNER TO postgres;

--
-- Name: page_facts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE page_facts_id_seq OWNED BY page_facts.id;


--
-- Name: page_facts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('page_facts_id_seq', 167, true);


--
-- Name: page_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE page_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.page_id_seq OWNER TO postgres;

--
-- Name: page_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('page_id_seq', 22, true);


--
-- Name: page_seo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE page_seo (
    id integer NOT NULL,
    title character varying(255),
    meta_description text,
    meta_keywods text
);


ALTER TABLE public.page_seo OWNER TO postgres;

--
-- Name: page_seo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE page_seo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.page_seo_id_seq OWNER TO postgres;

--
-- Name: page_seo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE page_seo_id_seq OWNED BY page_seo.id;


--
-- Name: page_seo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('page_seo_id_seq', 3, true);


--
-- Name: people; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE people (
    id integer NOT NULL,
    portal_id integer,
    type integer,
    photo integer,
    full_name character varying(255),
    job text,
    state integer DEFAULT 1,
    contact_address character varying(255),
    contact_phone character varying(255),
    contact_fax character varying(255),
    contact_site character varying(255),
    contact_email character varying(255),
    main_info text,
    life text,
    social_vk character varying(255),
    social_tw character varying(255),
    social_fb character varying(255),
    date character varying(255),
    office_type_id smallint DEFAULT 0,
    is_deleted integer DEFAULT 0 NOT NULL,
    "positionFile" integer
);


ALTER TABLE public.people OWNER TO postgres;

--
-- Name: COLUMN people.portal_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.portal_id IS 'Портал';


--
-- Name: COLUMN people.type; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.type IS 'Тип';


--
-- Name: COLUMN people.photo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.photo IS 'Фото';


--
-- Name: COLUMN people.full_name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.full_name IS 'ФИО';


--
-- Name: COLUMN people.job; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.job IS 'Место работы, должность, род занятий';


--
-- Name: COLUMN people.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.state IS 'Опубликовать';


--
-- Name: COLUMN people.contact_address; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.contact_address IS 'Адрес';


--
-- Name: COLUMN people.contact_phone; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.contact_phone IS 'Телефон';


--
-- Name: COLUMN people.contact_fax; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.contact_fax IS 'Факс';


--
-- Name: COLUMN people.contact_site; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.contact_site IS 'Сайт';


--
-- Name: COLUMN people.contact_email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.contact_email IS 'E-mail';


--
-- Name: COLUMN people.main_info; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.main_info IS 'Общая информация';


--
-- Name: COLUMN people.life; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.life IS 'Биография';


--
-- Name: COLUMN people.social_vk; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.social_vk IS 'Ссылка vkontakte';


--
-- Name: COLUMN people.social_tw; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.social_tw IS 'Ссылка twitter';


--
-- Name: COLUMN people.social_fb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people.social_fb IS 'Ссылка facebook';


--
-- Name: people_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE people_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.people_id_seq OWNER TO postgres;

--
-- Name: people_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE people_id_seq OWNED BY people.id;


--
-- Name: people_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('people_id_seq', 44, true);


--
-- Name: people_staff; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE people_staff (
    id integer NOT NULL,
    people_id integer,
    photo integer,
    full_name character varying(255),
    job text,
    cabinet character varying(255),
    contact_phone character varying(255),
    contact_fax character varying(255),
    contact_email character varying(255),
    portal_id integer,
    date character varying(255),
    unit_id smallint DEFAULT 0,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.people_staff OWNER TO postgres;

--
-- Name: COLUMN people_staff.people_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_staff.people_id IS 'Персоналия';


--
-- Name: COLUMN people_staff.photo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_staff.photo IS 'Фото';


--
-- Name: COLUMN people_staff.full_name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_staff.full_name IS 'ФИО';


--
-- Name: COLUMN people_staff.job; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_staff.job IS 'Место работы, должность, род занятий';


--
-- Name: COLUMN people_staff.cabinet; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_staff.cabinet IS 'Кабинет';


--
-- Name: COLUMN people_staff.contact_phone; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_staff.contact_phone IS 'Телефон';


--
-- Name: COLUMN people_staff.contact_fax; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_staff.contact_fax IS 'Факс';


--
-- Name: COLUMN people_staff.contact_email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_staff.contact_email IS 'E-mail';


--
-- Name: people_staff_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE people_staff_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.people_staff_id_seq OWNER TO postgres;

--
-- Name: people_staff_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE people_staff_id_seq OWNED BY people_staff.id;


--
-- Name: people_staff_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('people_staff_id_seq', 82, true);


--
-- Name: people_unit; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE people_unit (
    id integer NOT NULL,
    people_id integer,
    name character varying(255),
    url character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL,
    content text
);


ALTER TABLE public.people_unit OWNER TO postgres;

--
-- Name: COLUMN people_unit.people_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_unit.people_id IS 'Персоналия';


--
-- Name: COLUMN people_unit.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_unit.name IS 'Название';


--
-- Name: COLUMN people_unit.url; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN people_unit.url IS 'Кабинет';


--
-- Name: people_unit_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE people_unit_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.people_unit_id_seq OWNER TO postgres;

--
-- Name: people_unit_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE people_unit_id_seq OWNED BY people_unit.id;


--
-- Name: people_unit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('people_unit_id_seq', 69, true);


--
-- Name: photo_gallery; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE photo_gallery (
    id bigint NOT NULL,
    portal_id integer NOT NULL,
    title character varying(255) NOT NULL,
    date integer,
    photo integer,
    preview text,
    description text,
    state integer,
    alias character(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.photo_gallery OWNER TO postgres;

--
-- Name: photo_gallery_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE photo_gallery_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.photo_gallery_id_seq OWNER TO postgres;

--
-- Name: photo_gallery_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE photo_gallery_id_seq OWNED BY photo_gallery.id;


--
-- Name: photo_gallery_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('photo_gallery_id_seq', 478, true);


--
-- Name: photo_gallery_photos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE photo_gallery_photos (
    id bigint NOT NULL,
    photo_gallery_id integer NOT NULL,
    title character varying(255),
    photo integer,
    state integer,
    ordi integer
);


ALTER TABLE public.photo_gallery_photos OWNER TO postgres;

--
-- Name: photo_gallery_photos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE photo_gallery_photos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.photo_gallery_photos_id_seq OWNER TO postgres;

--
-- Name: photo_gallery_photos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE photo_gallery_photos_id_seq OWNED BY photo_gallery_photos.id;


--
-- Name: photo_gallery_photos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('photo_gallery_photos_id_seq', 513, true);


--
-- Name: portal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE portal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.portal_id_seq OWNER TO postgres;

--
-- Name: portal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('portal_id_seq', 98, true);


--
-- Name: portal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE portal (
    id integer DEFAULT nextval('portal_id_seq'::regclass) NOT NULL,
    title character varying(255) NOT NULL,
    alias character varying(255) NOT NULL,
    theme character varying(25) DEFAULT 'iogv'::character varying NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.portal OWNER TO postgres;

--
-- Name: portal_group; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE portal_group (
    id integer NOT NULL,
    name character varying(500)
);


ALTER TABLE public.portal_group OWNER TO postgres;

--
-- Name: portal_group_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE portal_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.portal_group_id_seq OWNER TO postgres;

--
-- Name: portal_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE portal_group_id_seq OWNED BY portal_group.id;


--
-- Name: portal_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('portal_group_id_seq', 5, true);


--
-- Name: public_report; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public_report (
    id integer NOT NULL,
    portal_id integer,
    date integer,
    file integer,
    type integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.public_report OWNER TO postgres;

--
-- Name: public_report_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public_report_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.public_report_id_seq OWNER TO postgres;

--
-- Name: public_report_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public_report_id_seq OWNED BY public_report.id;


--
-- Name: public_report_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public_report_id_seq', 1, false);


--
-- Name: rating_doc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rating_doc (
    id integer NOT NULL,
    title character varying(500) NOT NULL,
    author character varying(500),
    info character varying(500),
    global_type integer NOT NULL,
    file integer,
    type integer,
    date integer NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.rating_doc OWNER TO postgres;

--
-- Name: rating_doc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rating_doc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.rating_doc_id_seq OWNER TO postgres;

--
-- Name: rating_doc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rating_doc_id_seq OWNED BY rating_doc.id;


--
-- Name: rating_doc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rating_doc_id_seq', 4, true);


--
-- Name: rating_email; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rating_email (
    id integer NOT NULL,
    fio character varying(500) NOT NULL,
    phone integer NOT NULL,
    email character varying(1000) NOT NULL,
    info character varying(1000) NOT NULL
);


ALTER TABLE public.rating_email OWNER TO postgres;

--
-- Name: rating_email_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rating_email_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.rating_email_id_seq OWNER TO postgres;

--
-- Name: rating_email_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rating_email_id_seq OWNED BY rating_email.id;


--
-- Name: rating_email_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rating_email_id_seq', 1, false);


--
-- Name: rating_project_file; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rating_project_file (
    id integer NOT NULL,
    title character varying(500) NOT NULL,
    project_id integer NOT NULL,
    ord integer DEFAULT 100,
    file integer NOT NULL,
    description character varying(1000) NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.rating_project_file OWNER TO postgres;

--
-- Name: rating_project_file_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rating_project_file_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.rating_project_file_id_seq OWNER TO postgres;

--
-- Name: rating_project_file_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rating_project_file_id_seq OWNED BY rating_project_file.id;


--
-- Name: rating_project_file_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rating_project_file_id_seq', 1, false);


--
-- Name: reception_schedule_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE reception_schedule_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.reception_schedule_id_seq OWNER TO postgres;

--
-- Name: reception_schedule_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE reception_schedule_id_seq OWNED BY appeal_schedule.id;


--
-- Name: reception_schedule_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('reception_schedule_id_seq', 4, true);


--
-- Name: settings_mail_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE settings_mail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.settings_mail_id_seq OWNER TO postgres;

--
-- Name: settings_mail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('settings_mail_id_seq', 2, true);


--
-- Name: settings_mail; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE settings_mail (
    id integer DEFAULT nextval('settings_mail_id_seq'::regclass) NOT NULL,
    portal_id integer NOT NULL,
    server_email character varying(255),
    type integer DEFAULT 0,
    smtp_host character varying(255),
    smtp_port integer,
    smtp_username character varying(255),
    smtp_password character varying(255),
    sendmail_path character varying(255)
);


ALTER TABLE public.settings_mail OWNER TO postgres;

--
-- Name: smi; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE smi (
    id integer NOT NULL,
    portal_id integer NOT NULL,
    date integer,
    photo integer,
    title character varying(255) NOT NULL,
    preview text,
    description text,
    state integer,
    photo_title character varying(255),
    source character varying(255),
    author character varying(255),
    source_link character varying(255),
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.smi OWNER TO postgres;

--
-- Name: smi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE smi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.smi_id_seq OWNER TO postgres;

--
-- Name: smi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE smi_id_seq OWNED BY smi.id;


--
-- Name: smi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('smi_id_seq', 2, true);


--
-- Name: sphinx; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sphinx (
    id bigint NOT NULL,
    url character varying(500) NOT NULL,
    path character varying(500) NOT NULL
);


ALTER TABLE public.sphinx OWNER TO postgres;

--
-- Name: sphinx_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sphinx_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sphinx_id_seq OWNER TO postgres;

--
-- Name: sphinx_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sphinx_id_seq OWNED BY sphinx.id;


--
-- Name: sphinx_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sphinx_id_seq', 197, true);


--
-- Name: staff; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE staff (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    contest_type integer,
    date integer,
    date_actual integer,
    organization character varying(255),
    "group" integer,
    category integer,
    responsibility text,
    education_level integer,
    education_direction integer,
    expirience integer,
    knowledge text,
    skill text,
    amount_min real,
    amount_max real,
    contract text,
    additional text,
    acts text,
    documents text,
    contact text,
    contest_result text,
    portal_id integer NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.staff OWNER TO postgres;

--
-- Name: staff_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE staff_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.staff_id_seq OWNER TO postgres;

--
-- Name: staff_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE staff_id_seq OWNED BY staff.id;


--
-- Name: staff_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('staff_id_seq', 6, true);


--
-- Name: static_page; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE static_page (
    id integer NOT NULL,
    portal_id integer NOT NULL,
    title character varying(255) NOT NULL,
    state integer DEFAULT 0,
    description text,
    preview text,
    date bigint,
    photo_gallery_id integer,
    video_gallery_id integer,
    file_group_id integer,
    links_group_id integer,
    additional_menu_id integer,
    info_thread integer,
    url_id integer,
    type_id integer DEFAULT 0,
    file_id integer,
    news_category_id integer,
    image_id integer,
    social integer DEFAULT 1,
    modify integer,
    is_deleted integer DEFAULT 0 NOT NULL,
    video_id integer,
    map_id integer,
    external_link character varying(500)
);


ALTER TABLE public.static_page OWNER TO postgres;

--
-- Name: static_page_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE static_page_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.static_page_id_seq OWNER TO postgres;

--
-- Name: static_page_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE static_page_id_seq OWNED BY static_page.id;


--
-- Name: static_page_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('static_page_id_seq', 2208, true);


--
-- Name: tbl_migration; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE public.tbl_migration OWNER TO postgres;

--
-- Name: url_manager; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE url_manager (
    id integer NOT NULL,
    url character varying(255),
    portal_id integer NOT NULL,
    title character varying(255),
    meta_description character varying(500),
    meta_keywods character varying(500)
);


ALTER TABLE public.url_manager OWNER TO postgres;

--
-- Name: url_manager_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE url_manager_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.url_manager_id_seq OWNER TO postgres;

--
-- Name: url_manager_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE url_manager_id_seq OWNED BY url_manager.id;


--
-- Name: url_manager_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('url_manager_id_seq', 959, true);


--
-- Name: usr_AuthAssignment; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "usr_AuthAssignment" (
    itemname character varying(64) NOT NULL,
    userid character varying(64) NOT NULL,
    bizrule text,
    data text
);


ALTER TABLE public."usr_AuthAssignment" OWNER TO postgres;

--
-- Name: usr_AuthItem; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "usr_AuthItem" (
    name character varying(64) NOT NULL,
    type integer NOT NULL,
    description text,
    bizrule text,
    data text
);


ALTER TABLE public."usr_AuthItem" OWNER TO postgres;

--
-- Name: usr_AuthItemChild; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "usr_AuthItemChild" (
    parent character varying(64) NOT NULL,
    child character varying(64) NOT NULL
);


ALTER TABLE public."usr_AuthItemChild" OWNER TO postgres;

--
-- Name: usr_profiles_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usr_profiles_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usr_profiles_user_id_seq OWNER TO postgres;

--
-- Name: usr_profiles_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usr_profiles_user_id_seq', 2, true);


--
-- Name: usr_profiles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usr_profiles (
    user_id integer DEFAULT nextval('usr_profiles_user_id_seq'::regclass) NOT NULL,
    first_name character varying(255),
    last_name character varying(255)
);


ALTER TABLE public.usr_profiles OWNER TO postgres;

--
-- Name: usr_profiles_fields_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usr_profiles_fields_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usr_profiles_fields_id_seq OWNER TO postgres;

--
-- Name: usr_profiles_fields_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usr_profiles_fields_id_seq', 3, true);


--
-- Name: usr_profiles_fields; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usr_profiles_fields (
    id integer DEFAULT nextval('usr_profiles_fields_id_seq'::regclass) NOT NULL,
    varname character varying(50) DEFAULT ''::character varying NOT NULL,
    title character varying(255) DEFAULT ''::character varying NOT NULL,
    field_type character varying(50) DEFAULT ''::character varying NOT NULL,
    field_size integer DEFAULT 0 NOT NULL,
    field_size_min integer DEFAULT 0 NOT NULL,
    required integer DEFAULT 0 NOT NULL,
    match character varying(255) DEFAULT ''::character varying NOT NULL,
    range character varying(255) DEFAULT ''::character varying NOT NULL,
    error_message character varying(255) DEFAULT ''::character varying NOT NULL,
    other_validator text,
    "default" character varying(255) DEFAULT ''::character varying NOT NULL,
    widget character varying(255) DEFAULT ''::character varying NOT NULL,
    widgetparams text,
    "position" integer DEFAULT 0 NOT NULL,
    visible integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.usr_profiles_fields OWNER TO postgres;

--
-- Name: usr_users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usr_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usr_users_id_seq OWNER TO postgres;

--
-- Name: usr_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usr_users_id_seq', 5, true);


--
-- Name: usr_users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usr_users (
    id integer DEFAULT nextval('usr_users_id_seq'::regclass) NOT NULL,
    username character varying(20) DEFAULT ''::character varying NOT NULL,
    password character varying(128) DEFAULT ''::character varying NOT NULL,
    email character varying(128) DEFAULT ''::character varying NOT NULL,
    activkey character varying(128) DEFAULT ''::character varying NOT NULL,
    superuser integer DEFAULT 0 NOT NULL,
    status integer DEFAULT 0 NOT NULL,
    create_at timestamp without time zone DEFAULT now() NOT NULL,
    lastvisit_at timestamp without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL
);


ALTER TABLE public.usr_users OWNER TO postgres;

--
-- Name: video_gallery; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE video_gallery (
    id integer NOT NULL,
    portal_id integer NOT NULL,
    alias character varying(255)
);


ALTER TABLE public.video_gallery OWNER TO postgres;

--
-- Name: video_gallery_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE video_gallery_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.video_gallery_id_seq OWNER TO postgres;

--
-- Name: video_gallery_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE video_gallery_id_seq OWNED BY video_gallery.id;


--
-- Name: video_gallery_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('video_gallery_id_seq', 1, false);


--
-- Name: video_gallery_videos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE video_gallery_videos (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    photo integer,
    link character varying(255),
    mp4 integer,
    ogv integer,
    webm integer,
    date integer,
    state integer,
    portal_id integer NOT NULL,
    video_gallery_id integer
);


ALTER TABLE public.video_gallery_videos OWNER TO postgres;

--
-- Name: video_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE video_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.video_id_seq OWNER TO postgres;

--
-- Name: video_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE video_id_seq OWNED BY video_gallery_videos.id;


--
-- Name: video_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('video_id_seq', 37, true);


--
-- Name: vote; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE vote (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    state integer,
    finish integer,
    portal_id integer NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.vote OWNER TO postgres;

--
-- Name: vote_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE vote_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.vote_id_seq OWNER TO postgres;

--
-- Name: vote_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE vote_id_seq OWNED BY vote.id;


--
-- Name: vote_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('vote_id_seq', 14, true);


--
-- Name: vote_item; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE vote_item (
    id bigint NOT NULL,
    vote_id integer NOT NULL,
    title character varying(255) NOT NULL,
    sort integer,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.vote_item OWNER TO postgres;

--
-- Name: vote_item_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE vote_item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.vote_item_id_seq OWNER TO postgres;

--
-- Name: vote_item_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE vote_item_id_seq OWNED BY vote_item.id;


--
-- Name: vote_item_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('vote_item_id_seq', 113, true);


--
-- Name: vote_user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE vote_user (
    id bigint NOT NULL,
    vote_id integer NOT NULL,
    vote_item_id integer NOT NULL,
    user_id integer NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.vote_user OWNER TO postgres;

--
-- Name: vote_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE vote_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.vote_user_id_seq OWNER TO postgres;

--
-- Name: vote_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE vote_user_id_seq OWNED BY vote_user.id;


--
-- Name: vote_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('vote_user_id_seq', 14, true);


--
-- Name: yiicache; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE yiicache (
    id character(128) NOT NULL,
    expire integer,
    value bytea
);


ALTER TABLE public.yiicache OWNER TO postgres;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ac_commission ALTER COLUMN id SET DEFAULT nextval('ac_commission_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ac_document ALTER COLUMN id SET DEFAULT nextval('ac_document_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ac_expertise ALTER COLUMN id SET DEFAULT nextval('ac_expertise_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ac_file ALTER COLUMN id SET DEFAULT nextval('ac_file_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ac_members ALTER COLUMN id SET DEFAULT nextval('ac_members_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ac_public ALTER COLUMN id SET DEFAULT nextval('ac_public_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ac_schedule ALTER COLUMN id SET DEFAULT nextval('ac_schedule_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY afisha ALTER COLUMN id SET DEFAULT nextval('afisha_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY afisha_conf ALTER COLUMN id SET DEFAULT nextval('afisha_conf_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY appeal_place ALTER COLUMN id SET DEFAULT nextval('appeal_place_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY appeal_review ALTER COLUMN id SET DEFAULT nextval('appeal_review_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY appeal_schedule ALTER COLUMN id SET DEFAULT nextval('reception_schedule_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY audio ALTER COLUMN id SET DEFAULT nextval('audio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY category_doc ALTER COLUMN id SET DEFAULT nextval('category_doc_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY category_post ALTER COLUMN id SET DEFAULT nextval('category_post_id_seq'::regclass);


--
-- Name: comment_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comments ALTER COLUMN comment_id SET DEFAULT nextval('comments_comment_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY committee ALTER COLUMN id SET DEFAULT nextval('committee_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY committee_department ALTER COLUMN id SET DEFAULT nextval('committee_department_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY committee_staff ALTER COLUMN id SET DEFAULT nextval('committee_staff_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contact ALTER COLUMN id SET DEFAULT nextval('contact_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contact_details ALTER COLUMN id SET DEFAULT nextval('contact_details_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contest ALTER COLUMN id SET DEFAULT nextval('contest_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY counters ALTER COLUMN id SET DEFAULT nextval('counters_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY discuss ALTER COLUMN id SET DEFAULT nextval('discuss_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY document_folder ALTER COLUMN id SET DEFAULT nextval('document_folder_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY documents ALTER COLUMN id SET DEFAULT nextval('documents_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executive ALTER COLUMN id SET DEFAULT nextval('executive_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY experts ALTER COLUMN id SET DEFAULT nextval('experts_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY experts_resources ALTER COLUMN id SET DEFAULT nextval('experts_resources_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY faqs ALTER COLUMN id SET DEFAULT nextval('faqs_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feedback ALTER COLUMN id SET DEFAULT nextval('feedback_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY folders_group ALTER COLUMN id SET DEFAULT nextval('folders_group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY government ALTER COLUMN id SET DEFAULT nextval('government_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY government_type ALTER COLUMN id SET DEFAULT nextval('government_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY gubernator ALTER COLUMN id SET DEFAULT nextval('gubernator_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY gubernator_info ALTER COLUMN id SET DEFAULT nextval('gubernator_info_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY hotlines ALTER COLUMN id SET DEFAULT nextval('hotlines_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ie_file ALTER COLUMN id SET DEFAULT nextval('ie_file_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY igov ALTER COLUMN id SET DEFAULT nextval('igov_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY independent_evaluation ALTER COLUMN id SET DEFAULT nextval('independent_evaluation_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY links_group ALTER COLUMN id SET DEFAULT nextval('links_group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY log ALTER COLUMN id SET DEFAULT nextval('log_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mail_email_list ALTER COLUMN id SET DEFAULT nextval('mail_email_list_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mail_group ALTER COLUMN id SET DEFAULT nextval('mail_group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mail_group_email_list ALTER COLUMN id SET DEFAULT nextval('mail_group_email_list_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mail_subscribe ALTER COLUMN id SET DEFAULT nextval('mail_subscribe_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mail_subscribe_files ALTER COLUMN id SET DEFAULT nextval('mail_subscribe_files_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mail_template ALTER COLUMN id SET DEFAULT nextval('mail_template_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY maps ALTER COLUMN id SET DEFAULT nextval('maps_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY news_subscribers ALTER COLUMN id SET DEFAULT nextval('news_subscribers_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY opendata ALTER COLUMN id SET DEFAULT nextval('opendata_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY opendata_settings ALTER COLUMN id SET DEFAULT nextval('opendata_settings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY opendata_version ALTER COLUMN id SET DEFAULT nextval('opendata_version_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "pageExecutives" ALTER COLUMN id SET DEFAULT nextval('"pageExecutives_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY page_facts ALTER COLUMN id SET DEFAULT nextval('page_facts_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY page_seo ALTER COLUMN id SET DEFAULT nextval('page_seo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY people ALTER COLUMN id SET DEFAULT nextval('people_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY people_staff ALTER COLUMN id SET DEFAULT nextval('people_staff_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY people_unit ALTER COLUMN id SET DEFAULT nextval('people_unit_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY photo_gallery ALTER COLUMN id SET DEFAULT nextval('photo_gallery_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY photo_gallery_photos ALTER COLUMN id SET DEFAULT nextval('photo_gallery_photos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY portal_group ALTER COLUMN id SET DEFAULT nextval('portal_group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public_report ALTER COLUMN id SET DEFAULT nextval('public_report_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rating_doc ALTER COLUMN id SET DEFAULT nextval('rating_doc_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rating_email ALTER COLUMN id SET DEFAULT nextval('rating_email_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rating_project_file ALTER COLUMN id SET DEFAULT nextval('rating_project_file_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY smi ALTER COLUMN id SET DEFAULT nextval('smi_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sphinx ALTER COLUMN id SET DEFAULT nextval('sphinx_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY staff ALTER COLUMN id SET DEFAULT nextval('staff_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY static_page ALTER COLUMN id SET DEFAULT nextval('static_page_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY url_manager ALTER COLUMN id SET DEFAULT nextval('url_manager_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY video_gallery ALTER COLUMN id SET DEFAULT nextval('video_gallery_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY video_gallery_videos ALTER COLUMN id SET DEFAULT nextval('video_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vote ALTER COLUMN id SET DEFAULT nextval('vote_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vote_item ALTER COLUMN id SET DEFAULT nextval('vote_item_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vote_user ALTER COLUMN id SET DEFAULT nextval('vote_user_id_seq'::regclass);


--
-- Data for Name: YiiLog; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "YiiLog" (id, level, category, logtime, message) FROM stdin;
\.
COPY "YiiLog" (id, level, category, logtime, message) FROM '$$PATH$$/2780.dat';

--
-- Data for Name: ac_commission; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ac_commission (id, portal_id, decree, regulation) FROM stdin;
\.
COPY ac_commission (id, portal_id, decree, regulation) FROM '$$PATH$$/2865.dat';

--
-- Data for Name: ac_document; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ac_document (id, portal_id, title, file, type_id, is_deleted) FROM stdin;
\.
COPY ac_document (id, portal_id, title, file, type_id, is_deleted) FROM '$$PATH$$/2859.dat';

--
-- Data for Name: ac_expertise; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ac_expertise (id, portal_id, title, file, date_start, date_finish, date_publish, executive_id, description, is_deleted) FROM stdin;
\.
COPY ac_expertise (id, portal_id, title, file, date_start, date_finish, date_publish, executive_id, description, is_deleted) FROM '$$PATH$$/2860.dat';

--
-- Data for Name: ac_file; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ac_file (id, title, file, type, is_deleted) FROM stdin;
\.
COPY ac_file (id, title, file, type, is_deleted) FROM '$$PATH$$/2858.dat';

--
-- Data for Name: ac_members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ac_members (id, portal_id, fio, post, is_deleted) FROM stdin;
\.
COPY ac_members (id, portal_id, fio, post, is_deleted) FROM '$$PATH$$/2863.dat';

--
-- Data for Name: ac_public; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ac_public (id, portal_id, post_type_id, fio, post, file, year, type, is_deleted) FROM stdin;
\.
COPY ac_public (id, portal_id, post_type_id, fio, post, file, year, type, is_deleted) FROM '$$PATH$$/2861.dat';

--
-- Data for Name: ac_schedule; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ac_schedule (id, portal_id, date, description, is_deleted) FROM stdin;
\.
COPY ac_schedule (id, portal_id, date, description, is_deleted) FROM '$$PATH$$/2864.dat';

--
-- Data for Name: afisha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY afisha (id, portal_id, title, place, duration, photo, date, state, state_date, preview, description, organizer, longitude, latitude, participant, is_deleted) FROM stdin;
\.
COPY afisha (id, portal_id, title, place, duration, photo, date, state, state_date, preview, description, organizer, longitude, latitude, participant, is_deleted) FROM '$$PATH$$/2781.dat';

--
-- Data for Name: afisha_conf; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY afisha_conf (id, portal_id, month_file, quarter_file, year_file) FROM stdin;
\.
COPY afisha_conf (id, portal_id, month_file, quarter_file, year_file) FROM '$$PATH$$/2782.dat';

--
-- Data for Name: appeal_place; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY appeal_place (id, portal_id, department, address, "time", head, phone, email, description, is_deleted) FROM stdin;
\.
COPY appeal_place (id, portal_id, department, address, "time", head, phone, email, description, is_deleted) FROM '$$PATH$$/2844.dat';

--
-- Data for Name: appeal_review; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY appeal_review (id, portal_id, file_id, year, description, is_deleted) FROM stdin;
\.
COPY appeal_review (id, portal_id, file_id, year, description, is_deleted) FROM '$$PATH$$/2843.dat';

--
-- Data for Name: appeal_schedule; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY appeal_schedule (id, job_title, name, date, is_deleted) FROM stdin;
\.
COPY appeal_schedule (id, job_title, name, date, is_deleted) FROM '$$PATH$$/2823.dat';

--
-- Data for Name: audio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY audio (id, title, description, wav, mp3, portal_id, file, is_deleted) FROM stdin;
\.
COPY audio (id, title, description, wav, mp3, portal_id, file, is_deleted) FROM '$$PATH$$/2783.dat';

--
-- Data for Name: category_doc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY category_doc (id, name) FROM stdin;
\.
COPY category_doc (id, name) FROM '$$PATH$$/2855.dat';

--
-- Data for Name: category_post; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY category_post (id, name, is_deleted) FROM stdin;
\.
COPY category_post (id, name, is_deleted) FROM '$$PATH$$/2862.dat';

--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comments (owner_name, owner_id, comment_id, parent_comment_id, creator_id, user_name, user_email, comment_text, create_time, update_time, status, is_deleted) FROM stdin;
\.
COPY comments (owner_name, owner_id, comment_id, parent_comment_id, creator_id, user_name, user_email, comment_text, create_time, update_time, status, is_deleted) FROM '$$PATH$$/2851.dat';

--
-- Data for Name: committee; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY committee (id, portal_id, name, description) FROM stdin;
\.
COPY committee (id, portal_id, name, description) FROM '$$PATH$$/2870.dat';

--
-- Data for Name: committee_department; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY committee_department (id, committee_id, name, description) FROM stdin;
\.
COPY committee_department (id, committee_id, name, description) FROM '$$PATH$$/2871.dat';

--
-- Data for Name: committee_staff; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY committee_staff (id, department_id, photo, full_name, contact_address, contact_phone, contact_fax, contact_site, contact_email, main_info, life, social_vk, social_tw, social_fb) FROM stdin;
\.
COPY committee_staff (id, department_id, photo, full_name, contact_address, contact_phone, contact_fax, contact_site, contact_email, main_info, life, social_vk, social_tw, social_fb) FROM '$$PATH$$/2872.dat';

--
-- Data for Name: contact; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY contact (id, portal_id, title, alias, address, photo, driving_directions, description, executive_id, is_deleted) FROM stdin;
\.
COPY contact (id, portal_id, title, alias, address, photo, driving_directions, description, executive_id, is_deleted) FROM '$$PATH$$/2845.dat';

--
-- Data for Name: contact_details; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY contact_details (id, contact_id, type, value, description, is_deleted) FROM stdin;
\.
COPY contact_details (id, contact_id, type, value, description, is_deleted) FROM '$$PATH$$/2846.dat';

--
-- Data for Name: contest; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY contest (id, org, title, description_small, description, date_start, date_end, date_placed, file, state, is_deleted) FROM stdin;
\.
COPY contest (id, org, title, description_small, description, date_start, date_end, date_placed, file, state, is_deleted) FROM '$$PATH$$/2840.dat';

--
-- Data for Name: counters; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY counters (id, title, code, portal_id) FROM stdin;
\.
COPY counters (id, title, code, portal_id) FROM '$$PATH$$/2784.dat';

--
-- Data for Name: discuss; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY discuss (id, portal_id, title, date_start, date_finish, date_publish, description, file, executive_id, is_deleted) FROM stdin;
\.
COPY discuss (id, portal_id, title, date_start, date_finish, date_publish, description, file, executive_id, is_deleted) FROM '$$PATH$$/2850.dat';

--
-- Data for Name: document_folder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY document_folder (id, title, description, photo, ordi, state, parent_id, group_id, is_deleted) FROM stdin;
\.
COPY document_folder (id, title, description, photo, ordi, state, parent_id, group_id, is_deleted) FROM '$$PATH$$/2785.dat';

--
-- Data for Name: documents; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY documents (id, folder_id, title, file, preview, ordi, date, number, note, public, pdf, doc, zip, change_date, description, executive_id, is_deleted) FROM stdin;
\.
COPY documents (id, folder_id, title, file, preview, ordi, date, number, note, public, pdf, doc, zip, change_date, description, executive_id, is_deleted) FROM '$$PATH$$/2786.dat';

--
-- Data for Name: executive; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY executive (id, name, is_deleted) FROM stdin;
\.
COPY executive (id, name, is_deleted) FROM '$$PATH$$/2847.dat';

--
-- Data for Name: experts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY experts (id, portal_id, type, fio, phone, email, contact_address, skills, education, scientific, profession_skill, history, sovet_id, experience, is_deleted) FROM stdin;
\.
COPY experts (id, portal_id, type, fio, phone, email, contact_address, skills, education, scientific, profession_skill, history, sovet_id, experience, is_deleted) FROM '$$PATH$$/2787.dat';

--
-- Data for Name: experts_resources; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY experts_resources (id, experts_id, type, url, is_deleted) FROM stdin;
\.
COPY experts_resources (id, experts_id, type, url, is_deleted) FROM '$$PATH$$/2788.dat';

--
-- Data for Name: faqs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY faqs (id, question, answer, ordi, is_deleted) FROM stdin;
\.
COPY faqs (id, question, answer, ordi, is_deleted) FROM '$$PATH$$/2789.dat';

--
-- Data for Name: feedback; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY feedback (id, type, fio, phone, email, text, is_deleted, portal_id) FROM stdin;
\.
COPY feedback (id, type, fio, phone, email, text, is_deleted, portal_id) FROM '$$PATH$$/2790.dat';

--
-- Data for Name: file; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY file (id, portal_id, origin_name, name, size, ext, date, user_id) FROM stdin;
\.
COPY file (id, portal_id, origin_name, name, size, ext, date, user_id) FROM '$$PATH$$/2791.dat';

--
-- Data for Name: folders_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY folders_group (id, alias, name, portal_id, is_deleted) FROM stdin;
\.
COPY folders_group (id, alias, name, portal_id, is_deleted) FROM '$$PATH$$/2792.dat';

--
-- Data for Name: government; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY government (id, parent_id, name, url, is_deleted) FROM stdin;
\.
COPY government (id, parent_id, name, url, is_deleted) FROM '$$PATH$$/2793.dat';

--
-- Data for Name: government_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY government_type (id, parent_id, name, is_deleted) FROM stdin;
\.
COPY government_type (id, parent_id, name, is_deleted) FROM '$$PATH$$/2794.dat';

--
-- Data for Name: gubernator; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY gubernator (id, title, state, url, is_deleted) FROM stdin;
\.
COPY gubernator (id, title, state, url, is_deleted) FROM '$$PATH$$/2795.dat';

--
-- Data for Name: gubernator_info; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY gubernator_info (id, fio, photo, type) FROM stdin;
\.
COPY gubernator_info (id, fio, photo, type) FROM '$$PATH$$/2796.dat';

--
-- Data for Name: hotlines; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY hotlines (id, name, phone, is_deleted) FROM stdin;
\.
COPY hotlines (id, name, phone, is_deleted) FROM '$$PATH$$/2797.dat';

--
-- Data for Name: ie_file; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ie_file (id, title, description, file, file_type, date, doc_type) FROM stdin;
\.
COPY ie_file (id, title, description, file, file_type, date, doc_type) FROM '$$PATH$$/2867.dat';

--
-- Data for Name: igov; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY igov (id, type, name) FROM stdin;
\.
COPY igov (id, type, name) FROM '$$PATH$$/2798.dat';

--
-- Data for Name: independent_evaluation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY independent_evaluation (id, link, portal_group_id, executive_id) FROM stdin;
\.
COPY independent_evaluation (id, link, portal_group_id, executive_id) FROM '$$PATH$$/2869.dat';

--
-- Data for Name: links; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY links (id, title, url, photo, ordi, group_id) FROM stdin;
\.
COPY links (id, title, url, photo, ordi, group_id) FROM '$$PATH$$/2799.dat';

--
-- Data for Name: links_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY links_group (id, portal_id, alias, is_deleted) FROM stdin;
\.
COPY links_group (id, portal_id, alias, is_deleted) FROM '$$PATH$$/2848.dat';

--
-- Data for Name: log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY log (id, "changedModel", "typeOfChange", "userId", date, portal_id) FROM stdin;
\.
COPY log (id, "changedModel", "typeOfChange", "userId", date, portal_id) FROM '$$PATH$$/2800.dat';

--
-- Data for Name: mail_email_list; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mail_email_list (id, email, first_name, last_name, surname, agreement, is_alert, is_deleted) FROM stdin;
\.
COPY mail_email_list (id, email, first_name, last_name, surname, agreement, is_alert, is_deleted) FROM '$$PATH$$/2801.dat';

--
-- Data for Name: mail_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mail_group (id, name, is_deleted) FROM stdin;
\.
COPY mail_group (id, name, is_deleted) FROM '$$PATH$$/2802.dat';

--
-- Data for Name: mail_group_email_list; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mail_group_email_list (id, list_id, group_id, is_deleted) FROM stdin;
\.
COPY mail_group_email_list (id, list_id, group_id, is_deleted) FROM '$$PATH$$/2803.dat';

--
-- Data for Name: mail_subscribe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mail_subscribe (id, group_id, template_id, sender_email, date, is_send, name, is_deleted) FROM stdin;
\.
COPY mail_subscribe (id, group_id, template_id, sender_email, date, is_send, name, is_deleted) FROM '$$PATH$$/2804.dat';

--
-- Data for Name: mail_subscribe_files; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mail_subscribe_files (id, subscribe_id, photo, is_deleted) FROM stdin;
\.
COPY mail_subscribe_files (id, subscribe_id, photo, is_deleted) FROM '$$PATH$$/2805.dat';

--
-- Data for Name: mail_template; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mail_template (id, name, content, is_deleted) FROM stdin;
\.
COPY mail_template (id, name, content, is_deleted) FROM '$$PATH$$/2806.dat';

--
-- Data for Name: maps; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY maps (id, name, head, area, people, site, path, pos_x, pos_y, is_city, "order") FROM stdin;
\.
COPY maps (id, name, head, area, people, site, path, pos_x, pos_y, is_city, "order") FROM '$$PATH$$/2807.dat';

--
-- Data for Name: nav_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY nav_items (id, title, parent_id, ordi, state, "menuId", photo, url_id, is_deleted, is_link) FROM stdin;
\.
COPY nav_items (id, title, parent_id, ordi, state, "menuId", photo, url_id, is_deleted, is_link) FROM '$$PATH$$/2808.dat';

--
-- Data for Name: nav_menu; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY nav_menu (id, name, portal_id, alias, is_deleted) FROM stdin;
\.
COPY nav_menu (id, name, portal_id, alias, is_deleted) FROM '$$PATH$$/2809.dat';

--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY news (id, portal_id, author, date, photo, title, preview, description, state, type, photo_title, url_id, social, modify, is_deleted) FROM stdin;
\.
COPY news (id, portal_id, author, date, photo, title, preview, description, state, type, photo_title, url_id, social, modify, is_deleted) FROM '$$PATH$$/2810.dat';

--
-- Data for Name: news_subscribers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY news_subscribers (id, portal_id, subscriber, email, is_deleted) FROM stdin;
\.
COPY news_subscribers (id, portal_id, subscriber, email, is_deleted) FROM '$$PATH$$/2842.dat';

--
-- Data for Name: news_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY news_type (id, alias, title, is_deleted) FROM stdin;
\.
COPY news_type (id, alias, title, is_deleted) FROM '$$PATH$$/2811.dat';

--
-- Data for Name: opendata; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY opendata (id, identifier, title, description, owner, responsible, phone, email, link, format, structure, date_init, date_last_change, last_content, date_actual, link_version, keyword, link_version_struct, version, portal_id, category, file, period, structure_file, view_count, is_deleted) FROM stdin;
\.
COPY opendata (id, identifier, title, description, owner, responsible, phone, email, link, format, structure, date_init, date_last_change, last_content, date_actual, link_version, keyword, link_version_struct, version, portal_id, category, file, period, structure_file, view_count, is_deleted) FROM '$$PATH$$/2812.dat';

--
-- Data for Name: opendata_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY opendata_settings (id, file) FROM stdin;
\.
COPY opendata_settings (id, file) FROM '$$PATH$$/2813.dat';

--
-- Data for Name: opendata_version; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY opendata_version (id, opendata_id, file, date, is_deleted) FROM stdin;
\.
COPY opendata_version (id, opendata_id, file, date, is_deleted) FROM '$$PATH$$/2814.dat';

--
-- Data for Name: pageExecutives; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "pageExecutives" (id, page_id, executive_id, url, is_deleted) FROM stdin;
\.
COPY "pageExecutives" (id, page_id, executive_id, url, is_deleted) FROM '$$PATH$$/2857.dat';

--
-- Data for Name: page_facts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY page_facts (id, page_id, text, is_deleted) FROM stdin;
\.
COPY page_facts (id, page_id, text, is_deleted) FROM '$$PATH$$/2815.dat';

--
-- Data for Name: page_seo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY page_seo (id, title, meta_description, meta_keywods) FROM stdin;
\.
COPY page_seo (id, title, meta_description, meta_keywods) FROM '$$PATH$$/2816.dat';

--
-- Data for Name: people; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY people (id, portal_id, type, photo, full_name, job, state, contact_address, contact_phone, contact_fax, contact_site, contact_email, main_info, life, social_vk, social_tw, social_fb, date, office_type_id, is_deleted, "positionFile") FROM stdin;
\.
COPY people (id, portal_id, type, photo, full_name, job, state, contact_address, contact_phone, contact_fax, contact_site, contact_email, main_info, life, social_vk, social_tw, social_fb, date, office_type_id, is_deleted, "positionFile") FROM '$$PATH$$/2817.dat';

--
-- Data for Name: people_staff; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY people_staff (id, people_id, photo, full_name, job, cabinet, contact_phone, contact_fax, contact_email, portal_id, date, unit_id, is_deleted) FROM stdin;
\.
COPY people_staff (id, people_id, photo, full_name, job, cabinet, contact_phone, contact_fax, contact_email, portal_id, date, unit_id, is_deleted) FROM '$$PATH$$/2818.dat';

--
-- Data for Name: people_unit; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY people_unit (id, people_id, name, url, is_deleted, content) FROM stdin;
\.
COPY people_unit (id, people_id, name, url, is_deleted, content) FROM '$$PATH$$/2819.dat';

--
-- Data for Name: photo_gallery; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY photo_gallery (id, portal_id, title, date, photo, preview, description, state, alias, is_deleted) FROM stdin;
\.
COPY photo_gallery (id, portal_id, title, date, photo, preview, description, state, alias, is_deleted) FROM '$$PATH$$/2820.dat';

--
-- Data for Name: photo_gallery_photos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY photo_gallery_photos (id, photo_gallery_id, title, photo, state, ordi) FROM stdin;
\.
COPY photo_gallery_photos (id, photo_gallery_id, title, photo, state, ordi) FROM '$$PATH$$/2821.dat';

--
-- Data for Name: portal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY portal (id, title, alias, theme, is_deleted) FROM stdin;
\.
COPY portal (id, title, alias, theme, is_deleted) FROM '$$PATH$$/2822.dat';

--
-- Data for Name: portal_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY portal_group (id, name) FROM stdin;
\.
COPY portal_group (id, name) FROM '$$PATH$$/2868.dat';

--
-- Data for Name: public_report; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public_report (id, portal_id, date, file, type, is_deleted) FROM stdin;
\.
COPY public_report (id, portal_id, date, file, type, is_deleted) FROM '$$PATH$$/2849.dat';

--
-- Data for Name: rating_doc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rating_doc (id, title, author, info, global_type, file, type, date, is_deleted) FROM stdin;
\.
COPY rating_doc (id, title, author, info, global_type, file, type, date, is_deleted) FROM '$$PATH$$/2852.dat';

--
-- Data for Name: rating_email; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rating_email (id, fio, phone, email, info) FROM stdin;
\.
COPY rating_email (id, fio, phone, email, info) FROM '$$PATH$$/2854.dat';

--
-- Data for Name: rating_project_file; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rating_project_file (id, title, project_id, ord, file, description, is_deleted) FROM stdin;
\.
COPY rating_project_file (id, title, project_id, ord, file, description, is_deleted) FROM '$$PATH$$/2853.dat';

--
-- Data for Name: settings_mail; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY settings_mail (id, portal_id, server_email, type, smtp_host, smtp_port, smtp_username, smtp_password, sendmail_path) FROM stdin;
\.
COPY settings_mail (id, portal_id, server_email, type, smtp_host, smtp_port, smtp_username, smtp_password, sendmail_path) FROM '$$PATH$$/2824.dat';

--
-- Data for Name: smi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY smi (id, portal_id, date, photo, title, preview, description, state, photo_title, source, author, source_link, is_deleted) FROM stdin;
\.
COPY smi (id, portal_id, date, photo, title, preview, description, state, photo_title, source, author, source_link, is_deleted) FROM '$$PATH$$/2825.dat';

--
-- Data for Name: sphinx; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sphinx (id, url, path) FROM stdin;
\.
COPY sphinx (id, url, path) FROM '$$PATH$$/2826.dat';

--
-- Data for Name: staff; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY staff (id, title, contest_type, date, date_actual, organization, "group", category, responsibility, education_level, education_direction, expirience, knowledge, skill, amount_min, amount_max, contract, additional, acts, documents, contact, contest_result, portal_id, is_deleted) FROM stdin;
\.
COPY staff (id, title, contest_type, date, date_actual, organization, "group", category, responsibility, education_level, education_direction, expirience, knowledge, skill, amount_min, amount_max, contract, additional, acts, documents, contact, contest_result, portal_id, is_deleted) FROM '$$PATH$$/2827.dat';

--
-- Data for Name: static_page; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY static_page (id, portal_id, title, state, description, preview, date, photo_gallery_id, video_gallery_id, file_group_id, links_group_id, additional_menu_id, info_thread, url_id, type_id, file_id, news_category_id, image_id, social, modify, is_deleted, video_id, map_id, external_link) FROM stdin;
\.
COPY static_page (id, portal_id, title, state, description, preview, date, photo_gallery_id, video_gallery_id, file_group_id, links_group_id, additional_menu_id, info_thread, url_id, type_id, file_id, news_category_id, image_id, social, modify, is_deleted, video_id, map_id, external_link) FROM '$$PATH$$/2828.dat';

--
-- Data for Name: tbl_migration; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_migration (version, apply_time) FROM stdin;
\.
COPY tbl_migration (version, apply_time) FROM '$$PATH$$/2829.dat';

--
-- Data for Name: url_manager; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY url_manager (id, url, portal_id, title, meta_description, meta_keywods) FROM stdin;
\.
COPY url_manager (id, url, portal_id, title, meta_description, meta_keywods) FROM '$$PATH$$/2841.dat';

--
-- Data for Name: usr_AuthAssignment; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "usr_AuthAssignment" (itemname, userid, bizrule, data) FROM stdin;
\.
COPY "usr_AuthAssignment" (itemname, userid, bizrule, data) FROM '$$PATH$$/2830.dat';

--
-- Data for Name: usr_AuthItem; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "usr_AuthItem" (name, type, description, bizrule, data) FROM stdin;
\.
COPY "usr_AuthItem" (name, type, description, bizrule, data) FROM '$$PATH$$/2831.dat';

--
-- Data for Name: usr_AuthItemChild; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "usr_AuthItemChild" (parent, child) FROM stdin;
\.
COPY "usr_AuthItemChild" (parent, child) FROM '$$PATH$$/2832.dat';

--
-- Data for Name: usr_profiles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usr_profiles (user_id, first_name, last_name) FROM stdin;
\.
COPY usr_profiles (user_id, first_name, last_name) FROM '$$PATH$$/2833.dat';

--
-- Data for Name: usr_profiles_fields; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usr_profiles_fields (id, varname, title, field_type, field_size, field_size_min, required, match, range, error_message, other_validator, "default", widget, widgetparams, "position", visible) FROM stdin;
\.
COPY usr_profiles_fields (id, varname, title, field_type, field_size, field_size_min, required, match, range, error_message, other_validator, "default", widget, widgetparams, "position", visible) FROM '$$PATH$$/2834.dat';

--
-- Data for Name: usr_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usr_users (id, username, password, email, activkey, superuser, status, create_at, lastvisit_at) FROM stdin;
\.
COPY usr_users (id, username, password, email, activkey, superuser, status, create_at, lastvisit_at) FROM '$$PATH$$/2835.dat';

--
-- Data for Name: video_gallery; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY video_gallery (id, portal_id, alias) FROM stdin;
\.
COPY video_gallery (id, portal_id, alias) FROM '$$PATH$$/2856.dat';

--
-- Data for Name: video_gallery_videos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY video_gallery_videos (id, title, description, photo, link, mp4, ogv, webm, date, state, portal_id, video_gallery_id) FROM stdin;
\.
COPY video_gallery_videos (id, title, description, photo, link, mp4, ogv, webm, date, state, portal_id, video_gallery_id) FROM '$$PATH$$/2836.dat';

--
-- Data for Name: vote; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY vote (id, title, description, state, finish, portal_id, is_deleted) FROM stdin;
\.
COPY vote (id, title, description, state, finish, portal_id, is_deleted) FROM '$$PATH$$/2837.dat';

--
-- Data for Name: vote_item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY vote_item (id, vote_id, title, sort, is_deleted) FROM stdin;
\.
COPY vote_item (id, vote_id, title, sort, is_deleted) FROM '$$PATH$$/2838.dat';

--
-- Data for Name: vote_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY vote_user (id, vote_id, vote_item_id, user_id, is_deleted) FROM stdin;
\.
COPY vote_user (id, vote_id, vote_item_id, user_id, is_deleted) FROM '$$PATH$$/2839.dat';

--
-- Data for Name: yiicache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY yiicache (id, expire, value) FROM stdin;
\.
COPY yiicache (id, expire, value) FROM '$$PATH$$/2866.dat';

--
-- Name: YiiLog_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "YiiLog"
    ADD CONSTRAINT "YiiLog_id_pkey" PRIMARY KEY (id);


--
-- Name: ac_commission_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ac_commission
    ADD CONSTRAINT ac_commission_pkey PRIMARY KEY (id);


--
-- Name: ac_document_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ac_document
    ADD CONSTRAINT ac_document_pkey PRIMARY KEY (id);


--
-- Name: ac_expertise_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ac_expertise
    ADD CONSTRAINT ac_expertise_pkey PRIMARY KEY (id);


--
-- Name: ac_file_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ac_file
    ADD CONSTRAINT ac_file_pkey PRIMARY KEY (id);


--
-- Name: ac_members_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ac_members
    ADD CONSTRAINT ac_members_pkey PRIMARY KEY (id);


--
-- Name: ac_public_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ac_public
    ADD CONSTRAINT ac_public_pkey PRIMARY KEY (id);


--
-- Name: ac_schedule_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ac_schedule
    ADD CONSTRAINT ac_schedule_pkey PRIMARY KEY (id);


--
-- Name: afisha_conf_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY afisha_conf
    ADD CONSTRAINT afisha_conf_pkey PRIMARY KEY (id);


--
-- Name: afisha_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY afisha
    ADD CONSTRAINT afisha_pkey PRIMARY KEY (id);


--
-- Name: appeal_place_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY appeal_place
    ADD CONSTRAINT appeal_place_pkey PRIMARY KEY (id);


--
-- Name: appeal_review_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY appeal_review
    ADD CONSTRAINT appeal_review_pkey PRIMARY KEY (id);


--
-- Name: audio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY audio
    ADD CONSTRAINT audio_pkey PRIMARY KEY (id);


--
-- Name: category_doc_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY category_doc
    ADD CONSTRAINT category_doc_pkey PRIMARY KEY (id);


--
-- Name: category_post_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY category_post
    ADD CONSTRAINT category_post_pkey PRIMARY KEY (id);


--
-- Name: comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (comment_id);


--
-- Name: committee_department_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY committee_department
    ADD CONSTRAINT committee_department_pkey PRIMARY KEY (id);


--
-- Name: committee_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY committee
    ADD CONSTRAINT committee_pkey PRIMARY KEY (id);


--
-- Name: committee_staff_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY committee_staff
    ADD CONSTRAINT committee_staff_pkey PRIMARY KEY (id);


--
-- Name: contact_details_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contact_details
    ADD CONSTRAINT contact_details_pkey PRIMARY KEY (id);


--
-- Name: contact_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contact
    ADD CONSTRAINT contact_pkey PRIMARY KEY (id);


--
-- Name: contest_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contest
    ADD CONSTRAINT contest_pkey PRIMARY KEY (id);


--
-- Name: counters_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY counters
    ADD CONSTRAINT counters_pkey PRIMARY KEY (id);


--
-- Name: discuss_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY discuss
    ADD CONSTRAINT discuss_pkey PRIMARY KEY (id);


--
-- Name: document_folder_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY document_folder
    ADD CONSTRAINT document_folder_pkey PRIMARY KEY (id);


--
-- Name: documents_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY documents
    ADD CONSTRAINT documents_pkey PRIMARY KEY (id);


--
-- Name: executive_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY executive
    ADD CONSTRAINT executive_pkey PRIMARY KEY (id);


--
-- Name: experts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY experts
    ADD CONSTRAINT experts_pkey PRIMARY KEY (id);


--
-- Name: experts_resources_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY experts_resources
    ADD CONSTRAINT experts_resources_pkey PRIMARY KEY (id);


--
-- Name: faqs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY faqs
    ADD CONSTRAINT faqs_pkey PRIMARY KEY (id);


--
-- Name: feedback_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY feedback
    ADD CONSTRAINT feedback_pkey PRIMARY KEY (id);


--
-- Name: file_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY file
    ADD CONSTRAINT file_id_pkey PRIMARY KEY (id);


--
-- Name: folders_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY folders_group
    ADD CONSTRAINT folders_group_pkey PRIMARY KEY (id);


--
-- Name: gubernator_info_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY gubernator_info
    ADD CONSTRAINT gubernator_info_pkey PRIMARY KEY (id);


--
-- Name: gubernator_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY gubernator
    ADD CONSTRAINT gubernator_pkey PRIMARY KEY (id);


--
-- Name: hotlines_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY hotlines
    ADD CONSTRAINT hotlines_pkey PRIMARY KEY (id);


--
-- Name: ie_file_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ie_file
    ADD CONSTRAINT ie_file_pkey PRIMARY KEY (id);


--
-- Name: igov_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY igov
    ADD CONSTRAINT igov_pkey PRIMARY KEY (id);


--
-- Name: independent_evaluation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY independent_evaluation
    ADD CONSTRAINT independent_evaluation_pkey PRIMARY KEY (id);


--
-- Name: links_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY links_group
    ADD CONSTRAINT links_group_pkey PRIMARY KEY (id);


--
-- Name: links_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY links
    ADD CONSTRAINT links_id_pkey PRIMARY KEY (id);


--
-- Name: mail_email_list_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mail_email_list
    ADD CONSTRAINT mail_email_list_pkey PRIMARY KEY (id);


--
-- Name: mail_group_email_list_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mail_group_email_list
    ADD CONSTRAINT mail_group_email_list_pkey PRIMARY KEY (id);


--
-- Name: mail_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mail_group
    ADD CONSTRAINT mail_group_pkey PRIMARY KEY (id);


--
-- Name: mail_subscribe_files_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mail_subscribe_files
    ADD CONSTRAINT mail_subscribe_files_pkey PRIMARY KEY (id);


--
-- Name: mail_subscribe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mail_subscribe
    ADD CONSTRAINT mail_subscribe_pkey PRIMARY KEY (id);


--
-- Name: mail_template_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mail_template
    ADD CONSTRAINT mail_template_pkey PRIMARY KEY (id);


--
-- Name: maps_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY maps
    ADD CONSTRAINT maps_pkey PRIMARY KEY (id);


--
-- Name: nav_items_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nav_items
    ADD CONSTRAINT nav_items_id_pkey PRIMARY KEY (id);


--
-- Name: nav_menu_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nav_menu
    ADD CONSTRAINT nav_menu_id_pkey PRIMARY KEY (id);


--
-- Name: news_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY news
    ADD CONSTRAINT news_id_pkey PRIMARY KEY (id);


--
-- Name: news_subscribers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY news_subscribers
    ADD CONSTRAINT news_subscribers_pkey PRIMARY KEY (id);


--
-- Name: news_type_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY news_type
    ADD CONSTRAINT news_type_id_pkey PRIMARY KEY (id);


--
-- Name: opendata_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY opendata
    ADD CONSTRAINT opendata_pkey PRIMARY KEY (id);


--
-- Name: opendata_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY opendata_settings
    ADD CONSTRAINT opendata_settings_pkey PRIMARY KEY (id);


--
-- Name: opendata_version_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY opendata_version
    ADD CONSTRAINT opendata_version_pkey PRIMARY KEY (id);


--
-- Name: pageExecutives_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "pageExecutives"
    ADD CONSTRAINT "pageExecutives_pkey" PRIMARY KEY (id);


--
-- Name: page_facts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY page_facts
    ADD CONSTRAINT page_facts_pkey PRIMARY KEY (id);


--
-- Name: page_seo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY page_seo
    ADD CONSTRAINT page_seo_pkey PRIMARY KEY (id);


--
-- Name: people_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY people
    ADD CONSTRAINT people_pkey PRIMARY KEY (id);


--
-- Name: people_staff_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY people_staff
    ADD CONSTRAINT people_staff_pkey PRIMARY KEY (id);


--
-- Name: people_unit_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY people_unit
    ADD CONSTRAINT people_unit_pkey PRIMARY KEY (id);


--
-- Name: photo_gallery_photos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY photo_gallery_photos
    ADD CONSTRAINT photo_gallery_photos_pkey PRIMARY KEY (id);


--
-- Name: photo_gallery_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY photo_gallery
    ADD CONSTRAINT photo_gallery_pkey PRIMARY KEY (id);


--
-- Name: pk_id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY log
    ADD CONSTRAINT pk_id PRIMARY KEY (id);


--
-- Name: portal_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY portal_group
    ADD CONSTRAINT portal_group_pkey PRIMARY KEY (id);


--
-- Name: portal_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY portal
    ADD CONSTRAINT portal_id_pkey PRIMARY KEY (id);


--
-- Name: public_report_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public_report
    ADD CONSTRAINT public_report_pkey PRIMARY KEY (id);


--
-- Name: rating_doc_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rating_doc
    ADD CONSTRAINT rating_doc_pkey PRIMARY KEY (id);


--
-- Name: rating_email_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rating_email
    ADD CONSTRAINT rating_email_pkey PRIMARY KEY (id);


--
-- Name: rating_project_file_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rating_project_file
    ADD CONSTRAINT rating_project_file_pkey PRIMARY KEY (id);


--
-- Name: settings_mail_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY settings_mail
    ADD CONSTRAINT settings_mail_id_pkey PRIMARY KEY (id);


--
-- Name: smi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY smi
    ADD CONSTRAINT smi_pkey PRIMARY KEY (id);


--
-- Name: sphinx_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sphinx
    ADD CONSTRAINT sphinx_pkey PRIMARY KEY (id);


--
-- Name: staff_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY staff
    ADD CONSTRAINT staff_pkey PRIMARY KEY (id);


--
-- Name: static_page_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY static_page
    ADD CONSTRAINT static_page_id_pkey PRIMARY KEY (id);


--
-- Name: tbl_migration_version_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_migration
    ADD CONSTRAINT tbl_migration_version_pkey PRIMARY KEY (version);


--
-- Name: url_manager_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY url_manager
    ADD CONSTRAINT url_manager_pkey PRIMARY KEY (id);


--
-- Name: usr_AuthAssignment_itemname_userid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "usr_AuthAssignment"
    ADD CONSTRAINT "usr_AuthAssignment_itemname_userid_pkey" PRIMARY KEY (itemname, userid);


--
-- Name: usr_AuthItemChild_parent_child_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "usr_AuthItemChild"
    ADD CONSTRAINT "usr_AuthItemChild_parent_child_pkey" PRIMARY KEY (parent, child);


--
-- Name: usr_AuthItem_name_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "usr_AuthItem"
    ADD CONSTRAINT "usr_AuthItem_name_pkey" PRIMARY KEY (name);


--
-- Name: usr_profiles_fields_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usr_profiles_fields
    ADD CONSTRAINT usr_profiles_fields_id_pkey PRIMARY KEY (id);


--
-- Name: usr_profiles_user_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usr_profiles
    ADD CONSTRAINT usr_profiles_user_id_pkey PRIMARY KEY (user_id);


--
-- Name: usr_users_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usr_users
    ADD CONSTRAINT usr_users_id_pkey PRIMARY KEY (id);


--
-- Name: video_gallery_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY video_gallery
    ADD CONSTRAINT video_gallery_pkey PRIMARY KEY (id);


--
-- Name: video_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY video_gallery_videos
    ADD CONSTRAINT video_pkey PRIMARY KEY (id);


--
-- Name: vote_item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY vote_item
    ADD CONSTRAINT vote_item_pkey PRIMARY KEY (id);


--
-- Name: vote_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY vote
    ADD CONSTRAINT vote_pkey PRIMARY KEY (id);


--
-- Name: vote_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY vote_user
    ADD CONSTRAINT vote_user_pkey PRIMARY KEY (id);


--
-- Name: yiicache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY yiicache
    ADD CONSTRAINT yiicache_pkey PRIMARY KEY (id);


--
-- Name: nav_items_menuId; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "nav_items_menuId" ON nav_items USING btree ("menuId");


--
-- Name: nav_items_parent_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX nav_items_parent_id ON nav_items USING btree (parent_id);


--
-- Name: usr_AuthItemChild_child; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "usr_AuthItemChild_child" ON "usr_AuthItemChild" USING btree (child);


--
-- Name: usr_users_email; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX usr_users_email ON usr_users USING btree (email);


--
-- Name: usr_users_username; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX usr_users_username ON usr_users USING btree (username);


--
-- Name: committee_department_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY committee_department
    ADD CONSTRAINT committee_department_id FOREIGN KEY (committee_id) REFERENCES committee(id);


--
-- Name: committee_department_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY committee_staff
    ADD CONSTRAINT committee_department_id FOREIGN KEY (department_id) REFERENCES committee_department(id);


--
-- Name: document_folder; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY documents
    ADD CONSTRAINT document_folder FOREIGN KEY (folder_id) REFERENCES document_folder(id);


--
-- Name: fk_vote_item; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vote_item
    ADD CONSTRAINT fk_vote_item FOREIGN KEY (vote_id) REFERENCES vote(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: gallery_photo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY photo_gallery_photos
    ADD CONSTRAINT gallery_photo FOREIGN KEY (photo_gallery_id) REFERENCES photo_gallery(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: nav_items_menuId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nav_items
    ADD CONSTRAINT "nav_items_menuId_fkey" FOREIGN KEY ("menuId") REFERENCES nav_menu(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usr_AuthAssignment_itemname_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "usr_AuthAssignment"
    ADD CONSTRAINT "usr_AuthAssignment_itemname_fkey" FOREIGN KEY (itemname) REFERENCES "usr_AuthItem"(name);


--
-- Name: usr_AuthItemChild_child_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "usr_AuthItemChild"
    ADD CONSTRAINT "usr_AuthItemChild_child_fkey" FOREIGN KEY (child) REFERENCES "usr_AuthItem"(name);


--
-- Name: usr_AuthItemChild_parent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "usr_AuthItemChild"
    ADD CONSTRAINT "usr_AuthItemChild_parent_fkey" FOREIGN KEY (parent) REFERENCES "usr_AuthItem"(name);


--
-- Name: usr_profiles_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usr_profiles
    ADD CONSTRAINT usr_profiles_user_id_fkey FOREIGN KEY (user_id) REFERENCES usr_users(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

