<?php

class ProjectTest extends UnitTestCase
{

  public function setUp()
  {
    //Set env varible to test data path
    global $old_env_var;
    $old_env_var = getenv("UMPLIFY_DIR");
    $umplify_dir = (dirname(__FILE__) . "/test_data/");
    putenv("UMPLIFY_DIR=$umplify_dir");
  }

  public function tearDown()
  {
    // Restore previous env variable for umplify_dir
    $restore_old_env_var = $GLOBALS["old_env_var"];
    putenv("UMPLIFY_DIR=$restore_old_env_var");
  }

  public function test_defaultListOwners()
  {
    $owners = Project::listOwners();
    $expected = array("myorg", "yourname");
    $this->assertEqual($expected, $owners);
  }

  public function test_defaultListProjects()
  {
    $projects = Project::listProjects("myorg");
    $expected = array("myproj", "otherproj");
    $this->assertEqual($expected, $projects);
  }

  public function test_defaultListBranches()
  {
    $branches = Project::listBranches("myorg", "myproj");
    $expected = array("master", "stable");
    $this->assertEqual($expected, $branches);
  }

  public function test_defaultListVersions()
  {
    $versions = Project::listVersions("myorg", "myproj", "master");
    $expected = array("v1", "v2");
    $this->assertEqual($expected, $versions);
  }

  public function test_listOwners()
  {
    $owners = Project::listOwners((dirname(__FILE__) . "/test_data/"));
    $expected = array("myorg", "yourname");
    $this->assertEqual($expected, $owners);
  }

  public function test_listProjects()
  {
    $projects = Project::listProjects("myorg", (dirname(__FILE__) . "/test_data/"));
    $expected = array("myproj", "otherproj");
    $this->assertEqual($expected, $projects);
  }

  public function test_listBranches()
  {
    $branches = Project::listBranches("myorg", "myproj", (dirname(__FILE__) . "/test_data/"));
    $expected = array("master", "stable");
    $this->assertEqual($expected, $branches);
  }

  public function test_listVersions()
  {
    $versions = Project::listVersions("myorg", "myproj", "master", (dirname(__FILE__) . "/test_data/"));
    $expected = array("v1", "v2");
    $this->assertEqual($expected, $versions);
  }

  public function test_getUmplifierScore2()
  {
    $score = Project::getUmplifierScore("yourname", "yourproj", "master", "v1", (dirname(__FILE__) . "/test_data/"));
    $expected = 2;
    $this->assertEqual($expected, $score);
  }

  public function test_getUmplifierScore1()
  {
    $score = Project::getUmplifierScore("myorg", "myproj", "master", "v2", (dirname(__FILE__) . "/test_data/"));
    $expected = 1;
    $this->assertEqual($expected, $score); 
  }

  public function test_getUmplifierScore0()
  {
    $score = Project::getUmplifierScore("myorg", "myproj", "stable", "v1", (dirname(__FILE__) . "/test_data/"));
    $expected = 0;
    $this->assertEqual($expected, $score); 
  }

  public function test_getUmplifierScoreF()
  {
    $score = Project::getUmplifierScore("myorg", "myproj", "master", "v1", (dirname(__FILE__) . "/test_data/"));
    $expected = -1;
    $this->assertEqual($expected, $score);
  }

  public function test_getUmplifierScoreNA()
  {
    $score = Project::getUmplifierScore("myorg", "otherproj", "master", "v1", (dirname(__FILE__) . "/test_data/"));
    $expected = null;
    $this->assertEqual($expected, $score);
  }

}

?>