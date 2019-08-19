<?php

namespace api\test\api;

use api\tests\ApiTester;
use common\fixtures\TokenFixture;
use common\fixtures\UserFixture;

class AuthCest
{
    /**
     * @param ApiTester $I

    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                //'dataFile' => codecept_data_dir() . 'user.php',
            ],
            'token' => [
                'class' => TokenFixture::class,
                'dataFile' => codecept_data_dir() . 'token.php',
            ],
        ]);
    } */

    /**
     * @param ApiTester $I
     */
    public function badMethod(ApiTester $I)
    {
        $I->sendGET('login');
        $I->seeResponseCodeIs(404);
        //$I->seeResponseIsJson();
    }

    /**
     * @param ApiTester $I
     */
    public function wrongCredentials(ApiTester $I)
    {
        $I->sendPOST('/auth/login', [
            'username' => 'test',
            'password' => 'testtest'
        ]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseContainsJson([
            'error' => true,
            'message' => 'Incorrect username or password.'
        ]);
    }

    /**
     * @param ApiTester $I
     */
    public function successLogin(ApiTester $I)
    {
        $I->sendPOST('/auth/login', [
            'username' => 'test',
            'password' => 'testtest'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$.token');
        $I->seeResponseJsonMatchesJsonPath('$.expired');
    }
}