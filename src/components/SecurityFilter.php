<?php


class SecurityFilter
{

    private static $ADMINISTRATOR = "ADMINISTRATOR";
    private static $MANAGER = "MANAGER";
    private static $EMPLOYEE = "EMPLOYEE";
    private static $NOONE = "NOONE";

    /**
     * @var array
     */
    private static $PERMISSIONS_SET = [];

    /**
     * @var UserDAO
     */
    private $userDAO;

    /**
     * SecurityFilter constructor.
     */
    public function __construct()
    {
        $this->userDAO = new UserDAO();

        SecurityFilter::$PERMISSIONS_SET = [
            "home.php" => [SecurityFilter::$EMPLOYEE],
            "howto.php" => [SecurityFilter::$EMPLOYEE],
            "profile.php" => [SecurityFilter::$EMPLOYEE],
            "spreadsheets.php" => [SecurityFilter::$EMPLOYEE],

            "management.php" => [SecurityFilter::$MANAGER, SecurityFilter::$ADMINISTRATOR],
        ];
    }

    /**
     * @param User $user
     * @param string $pageName
     * @return bool
     */
    public function isAccessGranted($user, $pageName)
    {
        return $this->checkPermissions($user, $pageName);
    }

    /**
     * @param User $user
     * @param $pageName
     * @return bool
     */
    private function checkPermissions($user = null, $pageName)
    {
        if (!hasKey($pageName, SecurityFilter::$PERMISSIONS_SET)) {
            return true;
        }

        $permissions = SecurityFilter::$PERMISSIONS_SET[$pageName];
        if ($user != null) {
            foreach ($permissions as $permission) {
                foreach ($user->getAccessLevels() as $level) {
                    if ($level->getName() == $permission) { // string comparisons, maybe change for strcmp later
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param $pageName
     * @return AccessLevel[]
     */
    public function getPageAccessLevels($pageName)
    {
        return SecurityFilter::$PERMISSIONS_SET[$pageName];
    }
}