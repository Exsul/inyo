--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: users; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA users;


ALTER SCHEMA users OWNER TO postgres;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: quotes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE quotes (
    publisher character varying(30),
    id integer NOT NULL,
    quote text NOT NULL,
    date date DEFAULT now() NOT NULL,
    ratio integer DEFAULT 0
);


ALTER TABLE quotes OWNER TO postgres;

--
-- Name: quotes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE quotes_id_seq
    START WITH 79
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE quotes_id_seq OWNER TO postgres;

--
-- Name: quotes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE quotes_id_seq OWNED BY quotes.id;


SET search_path = users, pg_catalog;

--
-- Name: info; Type: TABLE; Schema: users; Owner: postgres; Tablespace: 
--

CREATE TABLE info (
    uid integer NOT NULL,
    name character varying(255)[]
);


ALTER TABLE info OWNER TO postgres;

--
-- Name: info_uid_seq; Type: SEQUENCE; Schema: users; Owner: postgres
--

CREATE SEQUENCE info_uid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE info_uid_seq OWNER TO postgres;

--
-- Name: info_uid_seq; Type: SEQUENCE OWNED BY; Schema: users; Owner: postgres
--

ALTER SEQUENCE info_uid_seq OWNED BY info.uid;


SET search_path = public, pg_catalog;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY quotes ALTER COLUMN id SET DEFAULT nextval('quotes_id_seq'::regclass);


SET search_path = users, pg_catalog;

--
-- Name: uid; Type: DEFAULT; Schema: users; Owner: postgres
--

ALTER TABLE ONLY info ALTER COLUMN uid SET DEFAULT nextval('info_uid_seq'::regclass);


SET search_path = public, pg_catalog;

--
-- Name: quotes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY quotes
    ADD CONSTRAINT quotes_pkey PRIMARY KEY (id);


SET search_path = users, pg_catalog;

--
-- Name: info_pkey; Type: CONSTRAINT; Schema: users; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY info
    ADD CONSTRAINT info_pkey PRIMARY KEY (uid);


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

