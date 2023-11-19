CREATE
OR REPLACE FUNCTION create_boombower_db() RETURNS void AS
$$
BEGIN
    CREATE
EXTENSION dblink;
   IF
NOT EXISTS (
      SELECT
      FROM   pg_catalog.pg_roles
      WHERE  rolname = 'boombower') THEN

CREATE ROLE boombower WITH SUPERUSER LOGIN PASSWORD 'boombower';
END IF;
   IF
EXISTS (SELECT FROM pg_database WHERE datname = 'boombower') THEN
      RAISE NOTICE 'Database already exists';
ELSE
      PERFORM dblink_exec('dbname=' || current_database()
                        , 'CREATE DATABASE boombower');
END IF;
   GRANT ALL PRIVILEGES ON DATABASE
boombower TO boombower;
END
$$
LANGUAGE plpgsql VOLATILE;

SELECT create_boombower_db();