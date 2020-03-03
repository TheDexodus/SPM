<?php
/* @var $article Article */

use app\modules\page\models\Article;

?>

<style>
    #rating {
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
    }

    #rating > span {
        display: inline-block;
        position: relative;
        width: 1.1em;
    }

    #rating > span:hover,
    #rating > span:hover ~ span {
        cursor: pointer;
        color: transparent;
    }
    #rating > span:hover:before,
    #rating > span:hover ~ span:before {
        content: "\2605";
        position: absolute;
        left: 0;
        color: gold;
    }

    .star-active {
        color: gold;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  var articleRating = <?=$article->rating?>;

  function vote (rating) {
    setVote(rating)
    $.get('/vote.html?article_id=<?=$article->id?>&rating=' + rating <?php if ($article->status === Article::STATUS_LINK) {
        echo '+ \'&link='.$article->link.'\'';
    } ?>)
      .done(function () {
        articleRating = rating
        document.getElementById('rating-result').innerHTML = 'The vote has been accepted'
      })
      .fail(function (data) {
        setVote(articleRating)
        document.getElementById('rating-result').innerHTML = data.responseText
      })
  }

  function setVote (rating) {
    if (rating >= 1) {
      document.getElementById('star_1').classList.add('star-active');
    } else {
      document.getElementById('star_1').classList.remove('star-active');
    }
    if (rating >= 2) {
      document.getElementById('star_2').classList.add('star-active');
    } else {
      document.getElementById('star_2').classList.remove('star-active');
    }
    if (rating >= 3) {
      document.getElementById('star_3').classList.add('star-active');
    } else {
      document.getElementById('star_3').classList.remove('star-active');
    }
    if (rating >= 4) {
      document.getElementById('star_4').classList.add('star-active');
    } else {
      document.getElementById('star_4').classList.remove('star-active');
    }
    if (rating >= 5) {
      document.getElementById('star_5').classList.add('star-active');
    } else {
      document.getElementById('star_5').classList.remove('star-active');
    }
  }
</script>

<div id="rating">
    <span id="star_5" onclick="vote(5)">☆</span>
    <span id="star_4" onclick="vote(4)">☆</span>
    <span id="star_3" onclick="vote(3)">☆</span>
    <span id="star_2" onclick="vote(2)">☆</span>
    <span id="star_1" onclick="vote(1)">☆</span>
</div>
<div style="text-align: center">
    <p id="rating-result"></p>
</div>

<script>
  setVote(articleRating)
</script>