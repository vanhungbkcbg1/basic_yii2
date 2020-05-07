<?php


namespace app\controllers;


use app\models\User;
use app\Services\UserService;
use bizley\jwt\Jwt;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token;
use Yii;
use yii\rest\ActiveController;

class AuthController extends ActiveController
{

    public $modelClass=User::class;

    /**
     * @var UserService $userService
     */
    private $userService;

    public function __construct($id, $module, $config = [],UserService $userService)
    {
        parent::__construct($id, $module, $config);
        $this->userService=$userService;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => \bizley\jwt\JwtHttpBearerAuth::class,
            "auth"=>function(Token $token){
                return $this->userService->find($token->getClaim("uid"));
            },
            "optional"=>[
                "login"
            ]
        ];

        return $behaviors;
    }

    public function actionUsers(){

        $data=[
            "username"=>"hungnv",
            "password"=>\Yii::$app->security->generatePasswordHash("123"),
            "email"=>"vanhungbkcbg1@gmail.com",
            "auth_key"=>123,
            "access_token"=>123
        ];

        $user=new User();
        $user->username="hungnv";
        $user->password=\Yii::$app->security->generatePasswordHash("123");
        $user->email="vanhungbkcbg1@gmail.com";
        $user->auth_key=123;
        $user->access_token=123;
        $user->save();
        return  "done";

        return $this->userService->insert($data);


    }

    public function actionTest(){

        return "valid token";
    }

    public function actionLogin(){
        $data=\Yii::$app->request->post();

        $user=$this->userService->findByEmail($data["email"]);

        //verify password
        if(\Yii::$app->getSecurity()->validatePassword($data["password"],$user->password)){
            //valid- generate token

            /**
             * @var Jwt $jwt
             */
            $jwt=Yii::$app->jwt;
            $signer = new Sha256();

            $token = (new Builder())->setIssuer('http://example.com') // Configures the issuer (iss claim)
            ->setAudience('http://example.org') // Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time()) // Configures the time that the token was issued (iat claim)
            ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
            ->set('uid', 1) // Configures a new claim, called "uid"
            ->sign($signer, $jwt->key) // creates a signature using "testing" as key
            ->getToken(); // Retrieves the generated token
            return  (string)$token;

        }else{
            return  "invalid email or password";
        }

        return $data;
    }
}