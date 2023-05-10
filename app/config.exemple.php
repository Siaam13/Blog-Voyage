<?php

/***************************************************
 * Do not modify this part
 ***************************************************/
const PROJECT_DIR = __DIR__ . '/..';
const TEMPLATE_DIR = PROJECT_DIR . '/templates';
/***************************************************/


/*************************************************
 * Adapt this part to your environment
 *************************************************/

// DATABASE connection
const DB_HOST = "your-host"; 
const DB_NAME = "your-db-name"; 
const DB_USER = "user";
const DB_PASS = "password";

// Base URL from the root of the web server
const BASE_URL = '/public-path-to-your-public-directory'; 

// The dsn of the SMTP server for sending mails
const MAILER_DSN = 'smtp://your-dsn';

// Email admin
const ADMIN_EMAIL = 'admin@your-site.com';