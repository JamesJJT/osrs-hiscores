<?php


namespace App\DataFormatter;


use App\Data\Skills;

/**
 * Class HiscoreFormat
 * @package App\DataFormatter
 */
class HiscoreFormat
{
    /**
     * @var array
     */
    protected $skills = Skills::SKILLS;

    /**
     * @var int
     */
    protected $count = Skills::COUNT;

    /**
     * @var array
     */
    protected $hiscore = [];

    /**
     * @var int
     */
    protected $amount = 0;

    /**
     * @param $response
     * @return mixed
     * @throws \Exception
     */
    public function formatHiscore($response)
    {
        $exploded = explode(PHP_EOL, $response);

        foreach($exploded as $skill){
            if ($this->amount === $this->count){
                break;
            }
            $skill = explode(',', $skill);
            $skill[0] = $this->skills[$this->amount];

            $this->hiscore[] = [
                'Name' => $skill[0],
                'Level' => $skill[1],
                'XP' => $skill[2],
                'Icon' => $this->skills[$this->amount] === "Overall" ? "https://oldschool.runescape.wiki/images/thumb/b/bd/Stats_icon.png/21px-Stats_icon.png" : 'https://www.runescape.com/img/rsp777/hiscores/skill_icon_'.strtolower($this->skills[$this->amount]).'1.gif'
            ];

            $this->amount++;
        }
        return $this->hiscore;
    }
}
