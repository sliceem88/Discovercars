<?php include_once('includes/header.php'); ?>

<div class="container">

    <button>
        <a href="/">Back to Homepage</a>
    </button>

    <div class="notification is-link is-light">We support only *.txt format</div>
    <div class="is-half">
        <form action="/Parser/execute" enctype="multipart/form-data" method="POST">
            <div class="file">
                <label class="file-label">
                    <input class="file-input" accept=".txt" type="file" id="textFile" name="textFile">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Choose a file…
                        </span>
                    </span>
                </label>
                <button type="submit" class="button is-link">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php

if (isset($data['error'])) {
    $errorMessage = $data['error'];

    echo "<div class='notification is-danger is-light'>Error accured: $errorMessage</div>";
} else {
    if ($data) {
        $letterCount = $data['letterCount'];

        echo "<div class='letter-count'>$letterCount</div>";
        echo "<div class='table-chart-wrapper'><table class='table is-bordered'><thead><tr><th>Letter</th><th>Count</th></tr></thead>";

        foreach ($data['topTen'] as $letter => $count) {
            echo " <tr><td>$letter</td><td>$count</td></tr>";
        }

        echo "</tbody></table>";
        echo '<div id="ct-chart" class="ct-chart ct-perfect-fourth"></div></div>';
    }
}
?>

<script>
    var data = {
        series: <?php echo json_encode(array_values($data['topTen'])); ?>
    };

    var sum = function(a, b) {
        return a + b
    };

    new Chartist.Pie('.ct-chart', data, {
        labelInterpolationFnc: function(value) {
            return Math.round(value / data.series.reduce(sum) * 100) + '%';
        }
    });
</script>

<?php include_once('includes/footer.php'); ?>