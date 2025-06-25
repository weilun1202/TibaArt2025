<?php
class Database {
    // private $host = "127.0.0.1";
    // private $user = "root";
    // private $pass = "password";
    // private $dbname = "TIBAART";
    // private $pdo;
    
    // Tibame 
    private $host = "127.0.0.1";
    private $user = "tibamefe_since2021";
    private $pass = "vwRBSb.j&K#E";
    private $dbname = "tibamefe_tjd101g2";
    
    public function __construct() {
        $this->connect();
    }
    
    private function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("資料庫連線失敗: " . $e->getMessage());
        }
    }
    
    public function getConnection() {
        return $this->pdo;
    }
    
    // 查詢用戶是否存在
    public function findUserByGoogleId($googleId) {
        $stmt = $this->pdo->prepare("SELECT * FROM MEMBER WHERE google_id = ?");
        $stmt->execute([$googleId]);
        return $stmt->fetch();
    }
    
    // 查詢用戶是否存在 (透過 email)
    public function findUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM MEMBER WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    
    // 建立新用戶
    public function createUser($userData) {
        $sql = "INSERT INTO MEMBER (google_id, email, name, img, register) 
                VALUES (?, ?, ?, ?, NOW())";
        
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            $userData['google_id'],
            $userData['email'],
            $userData['name'],
            $userData['img'] ?? null
        ]);
        
        if ($result) {
            return $this->pdo->lastInsertId();
        }
        return false;
    }
    
    // 更新用戶最後登入時間
    public function updateLastLogin($userId) {
        $stmt = $this->pdo->prepare("UPDATE MEMBER SET register = NOW() WHERE id = ?");
        return $stmt->execute([$userId]);
    }
    
    // 更新用戶資訊
    public function updateUser($userId, $userData) {
        $sql = "UPDATE MEMBER SET name = ?, img = ?, updated = NOW() WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $userData['name'],
            $userData['img'] ?? null,
            $userId
        ]);
    }
}
?>