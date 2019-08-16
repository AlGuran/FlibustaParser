CREATE TABLE authors
(
  id integer NOT NULL,
  add_date timestamp without time zone DEFAULT now(),
  CONSTRAINT authors_pkey PRIMARY KEY (id)
);

CREATE TABLE books
(
  id integer NOT NULL,
  author_id integer NOT NULL,
  add_date timestamp without time zone DEFAULT now(),
  checked boolean DEFAULT FALSE,
  CONSTRAINT books_pkey PRIMARY KEY (id)
);