<nav aria-label=" Page navigation">
    <ul class="pagination justify-content-center">
        <?php // if($page_no > 1){ echo "<li class='page-item'><a  class='page-link'  href='?comment_no=1'>First Page</a></li>"; } ?>

        <li class='page-item' <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
            <a class='page-link' <?php if($page_no > 1){ echo "href='?tid=$tid&&topicpageno=$previous_page'"; } ?>>Previous</a>
        </li>

        <?php
        if ($total_no_of_pages <= 10){
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                if ($counter == $page_no) {
                    echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                }else{
                    echo "<li class='page-item'><a  class='page-link' href='?tid=$tid&&topicpageno=$counter'>$counter</a></li>";
                }
            }
        }
        elseif($total_no_of_pages > 10){

            if($page_no <= 4) {
                for ($counter = 1; $counter < 8; $counter++){
                    if ($counter == $page_no) {
                        echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                    }else{
                        echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=$second_last'>$second_last</a></li>";
                echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=$total_no_of_pages'>$total_no_of_pages</a></li>";
            }

            elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=1'>1</a></li>";
                echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=2'>2</a></li>";
                echo "<li><a>...</a></li>";
                for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                    if ($counter == $page_no) {
                        echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                    }else{
                        echo "<li class='page-item'><a  class='page-link'  href='?qaid=$qaid?tid=$tid&&topicpageno=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=$second_last'>$second_last</a></li>";
                echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=$total_no_of_pages'>$total_no_of_pages</a></li>";
            }

            else {
                echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=1'>1</a></li>";
                echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=2'>2</a></li>";
                echo "<li><a>...</a></li>";

                for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                    if ($counter == $page_no) {
                        echo "<li  class='active page-item'><a class='page-link'>$counter</a></li>";
                    }else{
                        echo "<li class='page-item'><a  class='page-link'  href='?qaid=$qaid?tid=$tid&&topicpageno=$counter'>$counter</a></li>";
                    }
                }
            }
        }
        ?>

        <li class='page-item' <?php if($page_no >= $total_no_of_pages){ echo "class='page-item disabled'"; } ?>>
            <a  class='page-link' <?php if($page_no < $total_no_of_pages) { echo "href='?tid=$tid&&topicpageno=$next_page'"; } ?>>Next</a>
        </li>
        <?php if($page_no < $total_no_of_pages){
            echo "<li class='page-item'><a  class='page-link'  href='?tid=$tid&&topicpageno=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
        } ?>
    </ul>
</nav>