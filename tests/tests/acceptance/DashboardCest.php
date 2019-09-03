<?php 

class DashboardCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToIndex(AcceptanceTester $I)
    {
        $I->login();
        $I->amOnPage('/');
        $I->dontSeePHPErrors();
        $I->see('Ваши последние изменения');
        $I->see('Последние изменения после ваших');
    }
}
