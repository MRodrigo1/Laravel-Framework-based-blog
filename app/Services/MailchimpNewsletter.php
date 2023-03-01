<?php

namespace App\Services;

class MailchimpNewsletter implements Newsletter
{
    public function __construct(protected \MailchimpMarketing\ApiClient $client){
 
    }

    public function subscribe(string $email,string $list = null) {
        //if empty take value
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list,[
            'email_address' => $email,
            'status' => 'subscribed'
    ]);
}
}