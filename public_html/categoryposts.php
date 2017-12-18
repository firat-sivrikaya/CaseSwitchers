<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\CategoryPosts</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><a class="navbar-brand navbar-link" href="#">CaseSwitchers </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="#">Home </a></li>
                    <li role="presentation"><a href="#">Posts </a></li>
                    <li role="presentation"><a href="#">Categories </a></li>
                    <li role="presentation"><a href="#">Users </a></li>
                    <li role="presentation"></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="#">Profile </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Category: <em>Blockchain</em></h1></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-9">
                <div class="row">
                    <div class="col-sm-8 col-sm-pull-1">
                        <input type="search" name="Search" value="Search" disabled="">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-default btn-sm" type="button">Search </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Entry</th>
                                <th>Author </th>
                                <th>Rating </th>
                                <th>Comments </th>
                                <th>Subcategory </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Explain Blockchain in 3 words</td>
                                <td>cspro </td>
                                <td>55 </td>
                                <td>122 </td>
                                <td>Subcategory1 </td>
                            </tr>
                            <tr>
                                <td>Future of Cryptocurrencies</td>
                                <td>jack30 </td>
                                <td>43 </td>
                                <td>22 </td>
                                <td>Subcategory2 </td>
                            </tr>
                            <tr>
                                <td>By 2040, There Will Be No World Without Bitcoin</td>
                                <td>h4x0r </td>
                                <td>55 </td>
                                <td>21 </td>
                                <td>Subcategory3 </td>
                            </tr>
                            <tr>
                                <td>Bitcoin will hit $10.000 by the end of 2017</td>
                                <td>aug30 </td>
                                <td>11 </td>
                                <td>403 </td>
                                <td>Subcategory4 </td>
                            </tr>
                            <tr>
                                <td>I've invested more than $100.000 in Bitcoin, AMA!</td>
                                <td>kevin17 </td>
                                <td>378 </td>
                                <td>555 </td>
                                <td>Subcategory5 </td>
                            </tr>
                            <tr>
                                <td>The Lightning Network</td>
                                <td>cryptoislove </td>
                                <td>389 </td>
                                <td>59 </td>
                                <td>Subcategory6 </td>
                            </tr>
                            <tr>
                                <td>Most profitable altcoins</td>
                                <td>chocho03 </td>
                                <td>77 </td>
                                <td>17 </td>
                                <td>Subcategory7 </td>
                            </tr>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><a class="btn btn-success" role="button" href="#">New Post</a></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Post</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <label>Post Title </label>
                        <input type="text">
                    </li>
                    <li class="list-group-item">
                        <label>Select Category</label>
                        <select>
                            <optgroup label="This is a group">
                                <option value="12" selected="">Blockchain</option>
                                <option value="13">This is item 2</option>
                                <option value="14">This is item 3</option>
                            </optgroup>
                        </select>
                    </li>
                    <li class="list-group-item">
                        <label>Select Subcategory</label>
                        <select>
                            <optgroup label="This is a group">
                                <option value="13">This is item 2</option>
                                <option value="12" selected="">Altcoins</option>
                                <option value="14">This is item 3</option>
                            </optgroup>
                        </select>
                    </li>
                    <li class="list-group-item">
                        <textarea class="input-lg">Put your post here</textarea>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" type="button">Submit </button>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>