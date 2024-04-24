<?php declare(strict_types=1);

namespace Seven\Api;

use Seven\Api\Resource\AnalyticsResource;
use Seven\Api\Resource\BalanceResource;
use Seven\Api\Resource\ContactsResource;
use Seven\Api\Resource\GroupsResource;
use Seven\Api\Resource\HooksResource;
use Seven\Api\Resource\JournalResource;
use Seven\Api\Resource\LookupResource;
use Seven\Api\Resource\NumbersResource;
use Seven\Api\Resource\PricingResource;
use Seven\Api\Resource\RcsResource;
use Seven\Api\Resource\SmsResource;
use Seven\Api\Resource\StatusResource;
use Seven\Api\Resource\SubaccountsResource;
use Seven\Api\Resource\ValidateForVoiceResource;
use Seven\Api\Resource\VoiceResource;

class Client extends BaseClient
{
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

    public function __construct(string $apiKey, string $sentWith = 'php-api', string $signingSecret = null)
    {
        parent::__construct($apiKey, $sentWith, $signingSecret);

        $this->analytics = new AnalyticsResource($this);
        $this->balance = new BalanceResource($this);
        $this->contacts = new ContactsResource($this);
        $this->groups = new GroupsResource($this);
        $this->hooks = new HooksResource($this);
        $this->journal = new JournalResource($this);
        $this->lookup = new LookupResource($this);
        $this->numbers = new NumbersResource($this);
        $this->pricing = new PricingResource($this);
        $this->rcs = new RcsResource($this);
        $this->sms = new SmsResource($this);
        $this->status = new StatusResource($this);
        $this->subaccounts = new SubaccountsResource($this);
        $this->validateForVoice = new ValidateForVoiceResource($this);
        $this->voice = new VoiceResource($this);
    }
}
