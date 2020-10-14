<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

/**
 * Class User
 * @package Source\Models
 */
class User extends DataLayer
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name", "email", "password"]);
    }

    /**
     * @return string|null
     */
    public function userEnrollments(): ?string
    {
        $enroll = (new Enrollment())->find()->order("created_at DESC")->group("user_id")->fetch(true);
        if ($enroll) {
            foreach ($enroll as $item) {
                $ids[] = $item->user_id;
            }
            return implode(",", $ids);
        }
        return null;
    }

    /**
     * @return int
     */
    public function courseCountStudent(): int
    {
        return (new Enrollment())->find("user_id = :uid", "uid={$this->id}")->count();
    }

    /**
     * @return array|mixed|null
     */
    public function studentEnroll()
    {
        return (new Enrollment())->find("user_id = :uid", "uid={$this->id}")->fetch();
    }

    /**
     * @return array|null
     */
    public function studentCourses(): ?array
    {
        $enroll = (new Enrollment())->find("user_id = :uid", "uid={$this->id}");
        if ($enroll->count()) {
            foreach ($enroll->fetch(true) as $enrollment) {
                $courses[] = (new Course())->findById($enrollment->course_id);
            }
            return $courses;
        }
        return null;
    }

    public function supportOpenCount(int $courseId)
    {
        return $supports = (new Support())->find("user_id = :uid AND course_id = :cid AND status = :s",
            "uid={$this->id}&cid={$courseId}&s=1")->count();
    }

    public function supportSolvedCount(int $courseId)
    {
        return $supports = (new Support())->find("user_id = :uid AND course_id = :cid AND status > :s",
            "uid={$this->id}&cid={$courseId}&s=1")->count();
    }


    /**
     * @return int
     */
    public function ordersCount(): int
    {
        return (new Order())->find("user_id = :uid", "uid={$this->id}")->count();
    }

    /**
     * @return int
     */
    public function supportsCount(): int
    {
        return (new Support())->find("user_id = :uid", "uid={$this->id}")->count();
    }


    /**
     * @return bool
     */
    public function save(): bool
    {
        if (
            !$this->validateEmail()
            || !$this->validatePassword()
            || !parent::save()
        ) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    protected function validateEmail(): bool
    {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new Exception("Informe um e-mail válido");
            return false;
        }

        $userByEmail = null;
        if (!$this->id) {
            $userByEmail = $this->find("email = :email", "email={$this->email}")->count();
        } else {
            $userByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
        }

        if ($userByEmail) {
            $this->fail = new Exception("Já existe uma conta com esse e-mail informado");
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    protected function validatePassword(): bool
    {
        if (empty($this->password) || strlen($this->password) < 5) {
            $this->fail = new Exception("Você precisa informar uma senha com pelo menos 5 caracteres");
            return false;
        }

        if (password_get_info($this->password)["algo"]) {
            return true;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return true;
    }
}