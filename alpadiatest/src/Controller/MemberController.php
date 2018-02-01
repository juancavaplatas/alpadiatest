<?php

namespace Alpadia\Controllers;

use Alpadia\Models\Repositories\MemberRepository as MemberRepository;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Query\Builder as Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MemberController
{
    private $logger;
    /**
     * HTTP response code
     *
     * @var int $code
     */
    public $code = 200;

    /**
     * Model error array
     *
     * @var array $error
     */
    public $errors = [];

    /**
     * Construct
     *
     * @param LoggerInterface $logger
     * @param Builder $table
     *
     * @return void
     */
    public function __construct(LoggerInterface $logger, Builder $table)
    {
        $this->logger = $logger;
        $this->Member = new MemberRepository($table);
    }

    /**
     * Add new member
     *
     * @param array $data Member data
     *
     * @return array Member added
     */
    public function add(array $data)
    {
        $member = $this->Member->add($data);
        if (empty($member)) {
            $this->code = 400;
            $this->errors = $this->Member->getErrors();
        };
        return $member;
    }

    /**
     * Add game to member collection
     *
     * @param int $id Member id
     * @param int $game_id Game id
     *
     * @return int True if added
     */
    public function addGame(int $id, int $game_id)
    {
        $updated = $this->Member->addGame($id, $game_id);
        if (!$updated) {
            $this->code = 204;
        }
        return $updated;
    }

    /**
     * Delete a member
     *
     * @param int $id Member id
     *
     * @return int True if delete
     */
    public function delete(int $id)
    {
        $deleted = $this->Member->delete($id);
        if (!$deleted) {
            $this->code = 204;
        }
        return $deleted;
    }

    /**
     * Delete a game from member collection
     *
     * @param int $id Member id
     * @param int $game_id Game id
     *
     * @return int True if deleted
     */
    public function deleteGame(int $member_id, int $game_id)
    {
        $updated = $this->Member->deleteGame($member_id, $game_id);
        if (!$updated) {
            $this->code = 204;
        }
        return $updated;
    }

    /**
     * Find a member
     *
     * @param int $id Member id
     *
     * @return array Member data
     */
    public function find(int $id): array
    {
        $member = $this->Member->find($id);
        if (empty($member)) {
            $this->code = 204;
        }
        return $member;
    }

    /**
     * Retrieve member games
     *
     * @param int $id Unique member id
     *
     * @return array
     */
    public function findGames(int $id) : array
    {
        return $this->Member->games($id);
    }

    /**
     * Get all members
     *
     * @return array Member collection
     */
    public function get() : array
    {
        return $this->Member->get();
    }

    /**
     * Update member data
     *
     * @param int $id Member unique id
     * @param array $data Member new data
     *
     * @return array Member data
     */
    public function update(int $id, array $data) : array
    {
        $member = $this->Member->update($id, $data);
        if (empty($member)) {
            $this->code = 204;
        }
        return $member;
    }
}

?>
