# Weirdly this column is not created when running automated tests, so we create it manually
CREATE TABLE tx_externalimporttest_order_items (
    sorting_foreign int(11) default 0 not null
);