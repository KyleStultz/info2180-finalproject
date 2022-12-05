<?php
session_start();
require "dbconnect.php";
if (isset($_SESSION['first_name'])&& isset($_SESSION['last_name'])){
    $tableconstruct = "";
    if($_GET['btn'] == "Support"){
        $type = "Support";
        $supportsql = "SELECT * FROM contacts WHERE type = :type";
        $supportstmt = $conn->prepare($supportsql);
        $supportstmt->execute(array(
            ':type' => $type
        ));
        $supportcontacts = $supportstmt->fetchAll(PDO::FETCH_ASSOC);
        $tableconstruct= "
        <section class=\"contactlistheadparent\">
        <h2 class=\"contactlisthead\"> Dashboard </h2>
        <button id=\"createcontactbtn\"> <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\"><path d=\"M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z\"/></svg> Add Contact </button>
    </section>
    <section class=\"contactlistfootparent\">
    <section id=\"filter\"> 
    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z\"/></svg>
        <span>Filter by: </span>
        <button id=\"all\"> All </button>
        <button id=\"SalesLeads\"> Sales Leads </button>
        <button id=\"Support\" class=\"active\"> Support </button>
        <button id=\"assigned\"> Assigned to me </button>
    </section>
    <table id='contacttable'>
        <thead>
            <th>Name</th> 
            <th>Email</th>
            <th>Company</th> 
            <th>Type</th>  
        </thead>";
    
                foreach($supportcontacts as $supportcontact){
                    $typeid="";
                    if($supportcontact['type'] == "Support"){
                        $typeid = "Support";
                    }
                    else if($supportcontact['type'] == "Sales Lead"){
                        $typeid = "SalesLead";
                    }
                    $capitaltype = strtoupper($supportcontact['type']);
                    $tableconstruct .= 
                    "<tr class=\"temprow\"> 
                     <td><b><span class=\"fullname\">{$supportcontact['title']} {$supportcontact['firstname']} {$supportcontact['lastname']}</span></b></td>
                     <td>{$supportcontact['email']} </td>
                     <td>{$supportcontact['company']} </td>
                     <td id={$typeid}><span>{$capitaltype}</span><a href=\"{$supportcontact['id']}\"> View </a></td>
                    </tr>";  
                 }
    
                 $tableconstruct.=  "</table></section>";
    }
    else if($_GET['btn'] == "assigned"){
        $myid = $_SESSION['uid'];
        $myctssql = "SELECT * FROM contacts WHERE assigned_to = :myid";
        $myctsstmt = $conn->prepare($myctssql);
        $myctsstmt->execute(array(
            ':myid' => $myid
        ));
        $mycontacts = $myctsstmt->fetchAll(PDO::FETCH_ASSOC);
        $tableconstruct= "
        <section class=\"contactlistheadparent\">
        <h2 class=\"contactlisthead\"> Dashboard </h2>
        <button id=\"createcontactbtn\"> <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\"><path d=\"M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z\"/></svg> Add Contact </button>
    </section>
    <section class=\"contactlistfootparent\">
    <section id=\"filter\"> 
    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z\"/></svg>
        <span>Filter by: </span>
        <button id=\"all\"> All </button>
        <button id=\"SalesLeads\"> Sales Leads </button>
        <button id=\"Support\"> Support </button>
        <button id=\"assigned\" class=\"active\"> Assigned to me </button>
    </section>
    <table id='contacttable'>
        <thead>
            <th>Name</th> 
            <th>Email</th>
            <th>Company</th> 
            <th>Type</th>  
        </thead>";
    
                foreach($mycontacts as $mycontact){
                    $typeid="";
                    if($mycontact['type'] == "Support"){
                        $typeid = "Support";
                    }
                    else if($mycontact['type'] == "Sales Lead"){
                        $typeid = "SalesLead";
                    }
                    $capitaltype = strtoupper($mycontact['type']);
                    $tableconstruct .= 
                    "<tr class=\"temprow\">
                     <td><span class=\"fullname\">{$mycontact['title']} {$mycontact['firstname']} {$mycontact['lastname']}</span></td>
                     <td>{$mycontact['email']} </td>
                     <td>{$mycontact['company']} </td>
                     <td id={$typeid}><span>{$capitaltype}</span><a href=\"{$mycontact['id']}\"> View </a></td>
                    </tr>";  
                 }
    
                 $tableconstruct.=  "</table></section>";
    }
    else if ($_GET['btn'] == "all"){
        $sql = "SELECT * FROM contacts";
        $stmt = $conn->query($sql);
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tableconstruct= "
            <section class=\"contactlistheadparent\">
                <h2 class=\"contactlisthead\"> Dashboard </h2>
                <button id=\"createcontactbtn\"> <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\"><path d=\"M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z\"/></svg> Add Contact </button>
            </section>
            <section class=\"contactlistfootparent\">
            <section id=\"filter\"> 
            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z\"/></svg>
                <span>Filter by: </span>
                <button id=\"all\" class=\"active\"> All </button>
                <button id=\"SalesLeads\"> Sales Leads </button>
                <button id=\"Support\"> Support </button>
                <button id=\"assigned\"> Assigned to me </button>
            </section>
            <table id='contacttable'>
                <thead>
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Company</th> 
                    <th>Type</th>  
                </thead>";
    
                foreach($contacts as $contact){
                    $namesql = "SELECT * FROM users WHERE id = :id";
                    $namestmt = $conn -> prepare($namesql);
                    $namestmt->execute(array(
                        ':id' => $contact['assigned_to']
                    ));
                    $user = $namestmt->fetch(PDO::FETCH_ASSOC);
                    $typeid="";
                    if($contact['type'] == "Support"){
                        $typeid = "Support";
                    }
                    else if($contact['type'] == "Sales Lead"){
                        $typeid = "SalesLead";
                    }
                    $capitaltype = strtoupper($contact['type']);
                    $tableconstruct .= 
                    "<tr class=\"temprow\"> 
                    <td><span class=\"fullname\">{$contact['title']} {$contact['firstname']} {$contact['lastname']}</span></td>
                    <td>{$contact['email']} </td>
                    <td>{$contact['company']} </td>
                    <td id={$typeid}><span>{$capitaltype}</span><a href=\"{$contact['id']}\"> View </a></td>
                    </tr>";  
                 }
    
                 $tableconstruct.=  "</table></section>";
    }
    else if($_GET['btn'] == "SalesLeads"){
        $type = "Sales Lead";
        $salesleadssql = "SELECT * FROM contacts WHERE type = :type";
        $salesleadsstmt = $conn->prepare($salesleadssql);
        $salesleadsstmt->execute(array(
            ':type' => $type
        ));
        $salesleadscontacts = $salesleadsstmt->fetchAll(PDO::FETCH_ASSOC);
        $tableconstruct= "
        <section class=\"contactlistheadparent\">
        <h2 class=\"contactlisthead\"> Dashboard </h2>
        <button id=\"createcontactbtn\"> <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\"><path d=\"M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z\"/></svg> Add Contact </button>
    </section>
    <section class=\"contactlistfootparent\">
    <section id=\"filter\"> 
    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z\"/></svg>
        <span>Filter by: </span>
        <button id=\"all\"> All </button>
        <button id=\"SalesLeads\" class=\"active\"> Sales Leads </button>
        <button id=\"Support\"> Support </button>
        <button id=\"assigned\"> Assigned to me </button>
    </section>
    <table id='contacttable'>
        <thead>
            <th>Name</th> 
            <th>Email</th>
            <th>Company</th> 
            <th>Type</th>  
        </thead>";
    
                foreach($salesleadscontacts as $salesleadscontact){
                    $typeid="";
                    if($salesleadscontact['type'] == "Support"){
                        $typeid = "Support";
                    }
                    else if($salesleadscontact['type'] == "Sales Lead"){
                        $typeid = "SalesLead";
                    }
                    $capitaltype = strtoupper($salesleadscontact['type']);
                    $tableconstruct .= 
                    "<tr class=\"temprow\"> 
                     <td><span class=\"fullname\">{$salesleadscontact['title']} {$salesleadscontact['firstname']} {$salesleadscontact['lastname']}</span></td>
                     <td>{$salesleadscontact['email']} </td>
                     <td>{$salesleadscontact['company']} </td>
                     <td id={$typeid}><span>{$capitaltype}</span><a href=\"{$salesleadscontact['id']}\"> View </a></td>
                    </tr>";  
                 }
    
                 $tableconstruct.=  "</table></section>";

    }

    echo $tableconstruct;
}
