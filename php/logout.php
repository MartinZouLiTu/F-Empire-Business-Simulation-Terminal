<?php
session_start();

if(session_destroy()) {
    header("Location: /F-Empire-Business-Simulation-Terminal/login.html");
}