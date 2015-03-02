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

  public function test_defaultListVersions()
  {
    $projects = Project::listVersions("myorg", "myproj");
    $expected = array("master", "v1");
    $this->assertEqual($expected, $projects);
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

  public function test_listVersions()
  {
    $versions = Project::listVersions("myorg", "myproj", (dirname(__FILE__) . "/test_data/"));
    $expected = array("master", "v1");
    $this->assertEqual($versions, $expected);
  }

}

?>