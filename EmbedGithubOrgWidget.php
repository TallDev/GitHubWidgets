<?php
$orgResived = false;
$templateResived = false;

if($_GET['org']) {
  $org = $_GET['org'];
  $orgResived = true;
}
if($_GET['template']) {
  $file = $_GET['template'];
  $templateResived = true;
}



if($orgResived && $templateResived) {

$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
  )
);

$context = stream_context_create($options);

// Org
$orgResponse = file_get_contents("http://api.github.com/orgs/" . $org, false, $context);

$orgResponseParse = json_decode($orgResponse, true);

// Repos
$reposResponse = file_get_contents("http://api.github.com/orgs/".$org."/repos", false, $context);

$reposResponseParse = json_decode($reposResponse, true);

// Template
$template = file_get_contents($file);

// User Information
$template = str_replace("§§§USERNAME§§§", $orgResponseParse["login"], $template);
$template = str_replace("§§§USERIMGURL§§§", $orgResponseParse["avatar_url"], $template);
$template = str_replace("§§§USERACCURL§§§", $orgResponseParse["html_url"], $template);
$template = str_replace("§§§BIO§§§", $orgResponseParse["bio"], $template);
$template = str_replace("§§§REPOS§§§", $orgResponseParse["public_repos"], $template);
$template = str_replace("§§§FOLLOWERS§§§", $orgResponseParse["followers"], $template);
$template = str_replace("§§§FOLLOWING§§§", $orgResponseParse["following"], $template);

  // Repo 1
if (count($reposResponseParse) >= 1) {

  $template = str_replace("§§§REPONAME1§§§", $reposResponseParse[0]["name"], $template);
  $template = str_replace("§§§REPOURL1§§§", $reposResponseParse[0]["html_url"], $template);
  $template = str_replace("§§§REPODES1§§§", $reposResponseParse[0]["description"], $template);
} else {
  $template = str_replace("§§§REPONAME1§§§", "Dieser Benutzer hat diese Repositorie nicht", $template);
  $template = str_replace("§§§REPOURL1§§§", "", $template);
  $template = str_replace("§§§REPODES1§§§", " ", $template);
}



// Repo 2
if (count($reposResponseParse) >= 2) {

  $template = str_replace("§§§REPONAME2§§§", $reposResponseParse[1]["name"], $template);
  $template = str_replace("§§§REPOURL2§§§", $reposResponseParse[1]["html_url"], $template);
  $template = str_replace("§§§REPODES2§§§", $reposResponseParse[1]["description"], $template);
} else {
  $template = str_replace("§§§REPONAME2§§§", "Dieser Benutzer hat diese Repositorie nicht", $template);
  $template = str_replace("§§§REPOURL2§§§", "", $template);
  $template = str_replace("§§§REPODES2§§§", " ", $template);
}


// Repo 3
if (count($reposResponseParse) >= 3) {

  $template = str_replace("§§§REPONAME3§§§", $reposResponseParse[2]["name"], $template);
  $template = str_replace("§§§REPOURL3§§§", $reposResponseParse[2]["html_url"], $template);
  $template = str_replace("§§§REPODES3§§§", $reposResponseParse[2]["description"], $template);
} else {
  $template = str_replace("§§§REPONAME3§§§", "Dieser Benutzer hat diese Repositorie nicht", $template);
  $template = str_replace("§§§REPOURL3§§§", "", $template);
  $template = str_replace("§§§REPODES3§§§", " ", $template);
}


echo $template;
} else {
  echo 'Please Use GET (EmbedGithubWidget.php?user=USERNAME&template=TemplateFile)';
}
 ?>
