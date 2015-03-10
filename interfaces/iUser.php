<?php

namespace interfaces;


interface iUser {
  public function LogInAction();

  public function LogInProcess($username, $password);

  public function SignInProcess($username, $password, $name, $secondname, $email, $phone, $birthday_day, $birthday_month, $birthday_year);

  public function LogOutAction();

  public function SignInAction();

  public function ChangePasswordAction();

  public function ChangeNameAction();

  public function ChangeEmailAction();

  public function isLoggedIn();

  public function findValidateUser($username, $password);
}
