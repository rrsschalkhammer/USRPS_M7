<?php
require_once 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\ParameterType;

$name = 'USRPS';
$date = new DateTime("5/10/2022");

echo "<h1>USRPS</h1>";

$connectionParams = [
   /* 'dbname' => 'USRPS',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql'*/
    'url' => 'mysql://root@localhost:3306/usrps',
];

try {
    $conn = DriverManager::getConnection($connectionParams);
    $sql = "SELECT * FROM game";
    $games = $conn->fetchAllAssociative($sql);
    $options = '';

    foreach ($games as $game) {
        echo 'Game Nr.' . $game['round'] . ': ' . $game['player1'] . ' hat ' . $game['player2'] . ' mit '
            . $game['symbolPlayer1'] . ' geschlagen,' . ' welcher ' . $game['symbolPlayer2'] . ' genommen hat, am '
            . $game['gameDate'] . ' um ' . $game['gameTime'] . '<br>';
            $options .= '<option value="'.$game['round'].'">' . $game['round'] . '</option>';
    }



} catch (Exception $e) {
    echo $e;
}

try {
    echo <<<HTML
<br>
       <form method="get">            
       <label>Add a Game
                <input name="game" required>
            </label>
            <br>
            <label>Add first Player
                <input name="player1" required>
            </label>
             <br>
            <label>Add second Player
                <input name="player2" required>
            </label>
        <br>
        <span>First hand: </span>
        <select name="symbolPlayer1" required> 
            <option value="Schere">Schere</option>
            <option value="Stein">Stein</option>
            <option value="Papier">Papier</option>
        </select> 
             
            <br>
            <span>Second hand: </span>
            <select name="symbolPlayer2" required> 
                <option value="Schere">Schere</option>
                <option value="Stein">Stein</option>
                <option value="Papier">Papier</option>
            </select> 
            <br>
            
         <label for="start">Date: </label>
            <input type="date" id="start" name="date" required>
            
         <br>
         <label for="time">Time: </label>
            <input type="time" name="time" id="time" required>
            <br>
            <br>
            <input type="submit" name="Submit" value="Submit" required>
        </form>
        
        <form method="get">
            <span>Delete a game: </span>
            <select name="deleteRound"> 
                $options
            </select>
            <input type="submit" name="Submit" value="Submit" required>
        </form>
HTML;

        if(isset($_GET['symbolPlayer1'])) {
            $queryBuilder = $conn->createQueryBuilder();
            $queryBuilder->insert('game')->values([
                'round' => '?',
                'player1' => '?',
                'player2' => '?',
                'symbolPlayer1' => '?',
                'symbolPlayer2' => '?',
                'gameDate' => '?',
                'gameTime' => '?',
            ])
                ->setParameter(0, $_GET['game'])
                ->setParameter(1, $_GET['player1'])
                ->setParameter(2, $_GET['player2'])
                ->setParameter(3, $_GET['symbolPlayer1'])
                ->setParameter(4, $_GET['symbolPlayer2'])
                ->setParameter(5, $_GET['date'])
                ->setParameter(6, $_GET['time'])
                ->executeQuery();
            header("Location: index.php");
        }

        elseif (isset($_GET['deleteRound'])) {
            $queryBuilder = $conn->createQueryBuilder();

            $queryBuilder
                ->delete('game')
                ->where('round = ?')
                ->setParameter(0, $_GET['deleteRound'], ParameterType::INTEGER)
                ->executeQuery();
            header("Location: index.php");
        }

} catch (Exception $e2){

}

echo "<span>&#169;Raul Schalkhammer</span>";

