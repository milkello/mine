<?php
	 if (isset($_GET['dashboard'])) {
		include 'dashboard.php';
	}
	if (isset($_GET['users'])) {
	    include 'adduser.php';
	}
	if (isset($_GET['addusers'])) {
	    include 'adduser.php';
	}
	if (isset($_GET['students'])) {
	    include 'students.php';
	}
	if (isset($_GET['addstudent'])) {
	    include 'addstudent.php';
	}
	if (isset($_GET['classes'])) {
	    include 'classes.php';
	}
	if (isset($_GET['addclass'])) {
	    include 'addclass.php';
	}
	if (isset($_GET['subject'])) {
	    include 'adduser.php';
	}
	if (isset($_GET['addsub'])) {
	    include 'adduser.php';
	}
	if (isset($_GET['assess'])) {
	    include 'adduser.php';
	}
	if (isset($_GET['addass'])) {
	    include 'adduser.php';
	}
	if (isset($_GET['term'])) {
	    include 'adduser.php';
	}
	if (isset($_GET['addterm'])) {
	    include 'adduser.php';
	}
	if (isset($_GET['report_cards'])) {
	    include 'report_cards.php';
	}
?>