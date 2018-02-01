<?php

namespace Alpadia\Controllers;

use Alpadia\Models\Entities\Member as Member;
use Alpadia\Models\Factories\MemberFactory as MemberFactory;

use Psr\Log\LoggerInterface;
use Illuminate\Database\Query\Builder as Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MemberController
{
    private $logger;
    protected $table;

    public $code = 200;

    public function __construct(LoggerInterface $logger, Builder $table)
    {
        $this->logger = $logger;
        $this->table = $table;
    }

    public function add(array $data)
    {
        $member = MemberFactory::createFromArray($data);
        if ($member->save()) {
            return $member->toArray();
        };

        $this->code = 400;
        return [];
    }

    public function delete(int $id)
    {
        $member = Member::where(["id"=>$id])->first();
        if ( isset($member) ) {
            return $member->delete();
        }
        $this->code = 204;
        return 0;
    }

    public function find(int $id): array
    {
        $member = Member::where(["id"=>$id])->first();
        if ($member) {
            return $member->toArray();
        }
        $this->code = 204;
        return [];
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
        $collection = Member::where(["id"=>$id])->first()->games()->get();
        return $collection->toArray();
    }

    public function get() : array
    {
        return Member::get()->toArray();
    }

    public function update(int $id, array $data) : array
    {
        $member = Member::where(["id" => $id])->update($data);
        return $this->find($id);
    }
}

?>
