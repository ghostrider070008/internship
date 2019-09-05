<?php

namespace app\models;

class Users extends UsersBase
{
    public $password;
    public $passwordRepeat;

    const SCENARIO_SIGNUP = 'signup';
    const SCENARIO_SIGNIN = 'signin';

    public function scenarioSignup()
    {
        $this->setScenario(self::SCENARIO_SIGNUP);
        return $this;
    }

    public function scenarioSignIn()
    {
        $this->setScenario(self::SCENARIO_SIGNIN);
        return $this;
    }

    public function rules()
    {
        return array_merge([
            ['password', 'string', 'min' => 8],
            ['password', 'required'],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password'],
            ['email','email'],
            ['email', 'exist', 'on' => self::SCENARIO_SIGNIN],
            [['email'], 'unique', 'on' => self::SCENARIO_SIGNUP],
        ],
            parent::rules()
        );
    }
}
