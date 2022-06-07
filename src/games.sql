DROP DATABASE IF EXISTS usrps;

create
    database usrps;

use usrps;

create table game
(
    round         int primary key,
    player1       varchar(20),
    player2       varchar(20),
    symbolPlayer1 varchar(10),
    symbolPlayer2 varchar(10),
    gameDate      date,
    gameTime      time
);

insert into game(round, player1, player2, symbolPlayer1, symbolPlayer2, gameDate, gameTime)
values (1, 'Raul Schalkhammer', 'Tobi Schmidt', 'Papier', 'Stein', '2021-08-19', '05:40:50');
insert into game(round, player1, player2, symbolPlayer1, symbolPlayer2, gameDate, gameTime)
values (2, 'Wolfgang', 'Pratter', 'Papier', 'Papier', '2022-06-06', '08:55:00');
insert into game(round, player1, player2, symbolPlayer1, symbolPlayer2, gameDate, gameTime)
values (3, 'David', 'Alaba', 'Stein', 'Stein', '2022-06-06', '09:15:00');
insert into game(round, player1, player2, symbolPlayer1, symbolPlayer2, gameDate, gameTime)
values (4, 'Toni', 'Polster', 'Stein', 'Papier', '2022-06-06', '10:15:00');
insert into game(round, player1, player2, symbolPlayer1, symbolPlayer2, gameDate, gameTime)
values (5, 'Andi', 'Herzog', 'Schere', 'Schere', '2022-06-06', '10:20:00');

select *
from game;