<?php 

class ProfileCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToUpdate(AcceptanceTester $I)
    {
        $I->login();
        $I->amOnPage('/profile');
        $I->lookForwardTo('Update profile');

        $I->click('Сохранить');
        $I->see('Для сохранения любых изменений укажите свой текущий пароль');

        $lastName = 'Codeceptionovich';
        $I->fillField('Отчество', $lastName);
        $I->click('Сохранить');

        $I->seeInField('Отчество', $lastName);
        $I->fillField('Текущий пароль', 'topsecurity+');
        $I->click('Сохранить');

        $I->see('Профиль успешно обновлен', '.alert-success');
    }
}
