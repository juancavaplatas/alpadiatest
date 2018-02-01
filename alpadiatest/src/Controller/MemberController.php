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
    public $code = 200;

    public function __construct(LoggerInterface $logger, Builder $table)
    {
        $this->logger = $logger;
        $this->Member = new MemberRepository($table);
    }

    public function add(array $data)
    {
        $member = $this->Member->add($data);
        if (empty($member)) {
            $this->code = 400;
        };
        return $member;
    }

    public function addGames(int $id, array $game_ids)
    {
        $updated = $this->Member->addGames($id, $game_ids);
        if (!$updated) {
            $this->code = 204;
        }
        return $updated;
    }

    public function delete(int $id)
    {
        $deleted = $this->Member->delete($id);
        if (!$deleted) {
            $this->code = 204;
        }
        return $deleted;
    }

    public function deleteGame(int $member_id, int $game_id)
    {
        $updated = $this->Member->deleteGame($member_id, $game_id);
        if (!$updated) {
            $this->code = 204;
        }
        return $updated;
    }

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

    public function get() : array
    {
        return $this->Member->get();
    }

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
