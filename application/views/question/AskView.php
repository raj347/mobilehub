<div class="container askForm">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <span class="glyphicon glyphicon-file">
                        </span>ASK A NEW QUESTION
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Title" required id="qTitle" />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Describe your problem here" rows="5" required id="qDesc"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tags">
                                    Tags</label> 
                                <a href="#" id="helpText" data-toggle="popover" title="" data-content="You can create tags either by pressing enter after each tag or by using commas to separate the tags. Eg : android, java, help" role="button" data-original-title="Quick Tip">(Help)</a>
                                <br>
                                <input type="text" data-role="tagsinput" class="form-control" id="qTags" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">
                                    Category</label>
                                <select class="form-control" id="qCategory">
                                    <?php foreach ($categories as $cate): ?>
                                        <option><?php echo $cate->categoryName ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button onclick="postQuestion();" class="btn btn-success btn-mg"><span class="glyphicon glyphicon-floppy-disk">
                                </span>Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="qError"></div>
</div>

<script type="text/javascript">
                                $(function() {
                                    $('#helpText').popover();
                                });
                                function postQuestion()
                                {
                                    $qTitle = $("#qTitle").val();
                                    $qDesc = $("#qDesc").val();
                                    $qTags = checkTags($("#qTags").val());
                                    $qCategory = (($("#qCategory")[0]).selectedIndex) + 1;
                                    $qAskerName = "<?php echo $name ?>";

                                    $jsonObj = {"Title": $qTitle, "Description": $qDesc, "Tags": $qTags, "Category": $qCategory, "AskerName": $qAskerName};

                                    if (!($qTitle === '' || $qDesc === '' || $qTags === '' || $qCategory === '')) {
                                        $.post("/MobileHub/index.php/api/question/post", $jsonObj, function(content) {

                                            // Deserialise the JSON
                                            content = jQuery.parseJSON(content);
                                            console.log(content);
                                            if (content.message === "Success") {
                                                $("#qError").removeClass('alert alert-danger');
                                                $("#qError").addClass('alert alert-success');
                                                $("#qError").text('Question posted!');
                                                window.location.href = "/MobileHub/index.php/";
                                            } else {
                                                $("#qError").addClass('alert alert-danger');
                                                $("#qError").text('Sorry, something went wrong when posting the question! Please try again');
                                            }
                                        }).fail(function() {
                                            $("#qError").addClass('alert alert-danger');
                                            $("#qError").text('Sorry, something went wrong when posting the question! Please try again');

                                        }), "json";



                                        return true;
                                    }

                                    function checkTags($tags) {
                                        return $tags;
                                    }
                                }
</script>