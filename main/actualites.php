<?php
$news = array(
    array(
        "title" => "New Game Announcement",
        "short_description" => "Exciting news! Introducing our highly anticipated upcoming game, 'Super Adventure Quest'!",
        "description" => "We are thrilled to announce our upcoming game, 'Super Adventure Quest'! Join us on an epic journey filled with action, puzzles, and breathtaking visuals.",
        "date" => "2023-07-16"
    ),
    array(
        "title" => "Development Update: Multiplayer Mode",
        "short_description" => "Exciting progress! Our latest game is getting even better with the implementation of an immersive multiplayer mode!",
        "description" => "We've been hard at work implementing an exciting multiplayer mode in our latest game. Prepare to team up with friends or compete against others in intense online battles. With robust matchmaking, leaderboard systems, and customizable characters, the multiplayer experience will keep you engaged and coming back for more!",
        "date" => "2023-07-14"
    ),
    array(
        "title" => "Release Date Confirmed",
        "short_description" => "Save the date! 'Mystic Universe' is arriving on October 15th, offering a breathtaking world of magic and adventure!",
        "description" => "Mark your calendars! 'Mystic Universe' will be launching on October 15th. Get ready to explore a vast and enchanting world filled with magic, creatures, and captivating stories. With rich lore, compelling quests, and stunning graphics, this game will transport you to a realm of fantasy and wonder.",
        "date" => "2023-07-10"
    )
);
?>

<div class="card bg-transparent border-0" style="width: 100%;">
    <?php
    $firstIteration = true;
    foreach ($news as $item) {
        $formattedDate = strftime('%x', strtotime($item['date']));
        if ($firstIteration) {
            $firstIteration = false;
    ?>
            <div class="rounded card-img-top d-flex justify-content-center align-items-center" style="max-height: 300px; overflow: hidden;">
                <h1 class="p-3 font-weight-bold" style="position: absolute; top: 0; left: 0;">Actualités</h1>
                <img src="data:image/jpeg;base64,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" width="100%" alt="">
            </div>
            <div class="card-body my-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title font-weight-bold m-0"><?= $item["title"] ?></h4>
                    <span class="small text-muted"><?= $formattedDate ?></span>
                </div>
                <p class="card-text"><?= $item["description"] ?></p>
            </div>
        <?php
            continue;
        }
        ?>
        <hr class="m-0" />
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <p class="font-weight-bold"><?= $item["title"] ?></p>
                <span class="small text-muted"><?= $formattedDate ?></span>
            </div>
            <p class="mb-0"><?= $item["short_description"] ?></p>
        </div>
    <?php
    }
    ?>
</div>