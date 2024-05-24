<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Client;
use Seven\Api\Resource\Analytics\AnalyticsResource;
use Seven\Api\Resource\Balance\BalanceResource;
use Seven\Api\Resource\Contacts\ContactsResource;
use Seven\Api\Resource\Groups\GroupsResource;
use Seven\Api\Resource\Hooks\HooksResource;
use Seven\Api\Resource\Journal\JournalResource;
use Seven\Api\Resource\Lookup\LookupResource;
use Seven\Api\Resource\Numbers\NumbersResource;
use Seven\Api\Resource\Pricing\PricingResource;
use Seven\Api\Resource\Rcs\RcsResource;
use Seven\Api\Resource\Sms\SmsResource;
use Seven\Api\Resource\Status\StatusResource;
use Seven\Api\Resource\Subaccounts\SubaccountsResource;
use Seven\Api\Resource\ValidateForVoice\ValidateForVoiceResource;
use Seven\Api\Resource\Voice\VoiceResource;

readonly class Resources {
    public AnalyticsResource $analytics;
    public BalanceResource $balance;
    public ContactsResource $contacts;
    public GroupsResource $groups;
    public HooksResource $hooks;
    public JournalResource $journal;
    public LookupResource $lookup;
    public NumbersResource $numbers;
    public PricingResource $pricing;
    public RcsResource $rcs;
    public SmsResource $sms;
    public StatusResource $status;
    public SubaccountsResource $subaccounts;
    public ValidateForVoiceResource $validateForVoice;
    public VoiceResource $voice;

    public function __construct(public Client $client) {
        $this->analytics = new AnalyticsResource($client);
        $this->balance = new BalanceResource($client);
        $this->contacts = new ContactsResource($client);
        $this->groups = new GroupsResource($client);
        $this->hooks = new HooksResource($client);
        $this->journal = new JournalResource($client);
        $this->lookup = new LookupResource($client);
        $this->numbers = new NumbersResource($client);
        $this->pricing = new PricingResource($client);
        $this->rcs = new RcsResource($client);
        $this->sms = new SmsResource($client);
        $this->status = new StatusResource($client);
        $this->subaccounts = new SubaccountsResource($client);
        $this->validateForVoice = new ValidateForVoiceResource($client);
        $this->voice = new VoiceResource($client);
    }
}
