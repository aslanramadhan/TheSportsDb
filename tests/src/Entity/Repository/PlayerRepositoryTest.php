<?php

namespace TheSportsDb\Test\Entity\Repository;

use TheSportsDb\Entity\PlayerInterface;
use TheSportsDb\Entity\Repository\PlayerRepository;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-09-14 at 09:38:15.
 */
class PlayerRepositoryTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var \TheSportsDb\Entity\Repository\PlayerRepository
   */
  protected $playerRepository;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    include __DIR__ . '/../../../../default_bootstrap.php';
    $this->playerRepository = isset($container) ? $container->get('thesportsdb.repository.player') : $repositoryContainer->getRepository('player');
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->playerRepository = NULL;
  }

  /**
   * @covers TheSportsDb\Entity\Repository\PlayerRepository::byTeamName
   * @covers TheSportsDb\Entity\Repository\Repository::normalizeArray
   * @covers TheSportsDb\Entity\Repository\Repository::normalizeEntity
   */
  public function testByTeamName() {
    $players = $this->playerRepository->byTeamName('Arsenal');
    $this->assertNotEmpty($players);

    foreach ($players as $player) {
      // Should be a player.
      $this->assertInstanceOf(PlayerInterface::class, $player);
      $this->assertContains('Arsenal', $player->getTeam()->getName(), '', FALSE);
    }

    // Try a fake team.
    $players = $this->playerRepository->byTeamName('FakeTeam123');
    $this->assertEmpty($players);
  }

  /**
   * @covers TheSportsDb\Entity\Repository\PlayerRepository::byName
   * @covers TheSportsDb\Entity\Repository\Repository::normalizeArray
   * @covers TheSportsDb\Entity\Repository\Repository::normalizeEntity
   */
  public function testByName() {
    $players = $this->playerRepository->byName('mario');
    $this->assertNotEmpty($players);

    foreach ($players as $player) {
      // Should be a player.
      $this->assertInstanceOf(PlayerInterface::class, $player);
      $this->assertContains('mario', $player->getName(), '', TRUE);
    }

    // Try a fake name.
    $players = $this->playerRepository->byName('FakePlayer123');
    $this->assertEmpty($players);
  }

  /**
   * @covers TheSportsDb\Entity\Repository\PlayerRepository::byTeamNameAndName
   * @covers TheSportsDb\Entity\Repository\Repository::normalizeArray
   * @covers TheSportsDb\Entity\Repository\Repository::normalizeEntity
   */
  public function testByTeamNameAndName() {
    $players = $this->playerRepository->byTeamNameAndName('Arsenal', 'Ivan');
    $this->assertNotEmpty($players);

    foreach ($players as $player) {
      // Should be a player.
      $this->assertInstanceOf(PlayerInterface::class, $player);
      $this->assertContains('Ivan', $player->getName(), '', TRUE);
      $this->assertContains('Arsenal', $player->getTeam()->getName(), '', TRUE);
    }

    // Try a fake team.
    $players = $this->playerRepository->byTeamNameAndName('FakeTeam123', 'Ivan');
    $this->assertEmpty($players);

    // Try a fake name.
    $players = $this->playerRepository->byTeamNameAndName('Arsenal', 'FakePlayer123');
    $this->assertEmpty($players);

    // Try a fake team and name.
    $players = $this->playerRepository->byTeamNameAndName('FakeTeam123', 'FakePlayer123');
    $this->assertEmpty($players);
  }

  /**
   * @covers TheSportsDb\Entity\Repository\PlayerRepository::byTeam
   * @covers TheSportsDb\Entity\Repository\Repository::normalizeArray
   * @covers TheSportsDb\Entity\Repository\Repository::normalizeEntity
   */
  public function testByTeam() {
    $players = $this->playerRepository->byTeam(133604);
    $this->assertNotEmpty($players);

    foreach ($players as $player) {
      // Should be a player.
      $this->assertInstanceOf(PlayerInterface::class, $player);
      $this->assertEquals(133604, $player->getTeam()->getId());
    }

    // Try a fake team.
    $players = $this->playerRepository->byTeam('FakeTeam123');
    $this->assertEmpty($players);
  }

}
