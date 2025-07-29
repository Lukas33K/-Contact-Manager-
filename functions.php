<?php

function loadContacts() {
    if (!file_exists('contacts.json')) {
        file_put_contents('contacts.json', '[]');
    }
    $data = file_get_contents('contacts.json');
    return json_decode($data, true);
}

function saveContacts($contacts) {
    file_put_contents('contacts.json', json_encode($contacts, JSON_PRETTY_PRINT));
}

function addContact($name, $email, $phone) {
    $contacts = loadContacts();
    $contacts[] = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone
    ];
    saveContacts($contacts);
}

function deleteContact($index) {
    $contacts = loadContacts();
    array_splice($contacts, $index, 1);
    saveContacts($contacts);
}