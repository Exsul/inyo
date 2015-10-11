#!/bin/bash
pg_dump -U postgres inyo --schema-only > sql/schema.sql
git add sql/schema.sql