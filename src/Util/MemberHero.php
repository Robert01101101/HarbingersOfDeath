<?php
namespace Util;

/**
 * Class MemberHero
 * @package Util\MemberHero
 */
class MemberHero {

    //Creates the hero string for logged in members. Only mention deaths that occured, format sentence correctly.
    public static function createMemberHero($omenCollection) : string
    {

        $heroText = "Omens have killed ";
        $deathYou = $omenCollection->getDeathYou();
        $deathFamily = $omenCollection->getDeathFamily();
        $deathFriend = $omenCollection->getDeathFriend();
        $deathCommunity = $omenCollection->getDeathCommunity();
        $commonFault = $omenCollection->getCommonFault();

        if ($deathYou > 0) { $heroText .= "you ".$deathYou." time"; if($deathYou !== 1) $heroText .= "s"; if ($deathFamily+$deathFriend+$deathCommunity > 0) $heroText .= ", and caused the death of "; }
        if ($deathFamily > 0) { $heroText .= $deathFamily." family member"; if($deathFamily !== 1) $heroText .= "s"; if ($deathFriend+$deathCommunity > 0) $heroText .= ", ";}
        if ($deathFriend > 0) { if ($deathCommunity === 0 && $deathFamily > 0) $heroText .= "and "; $heroText .= $deathFriend." friend"; if($deathFriend !== 1) $heroText .= "s"; if ($deathCommunity > 0) $heroText .= ", ";}
        if ($deathCommunity > 0) { if ($deathFamily+$deathFriend > 0) $heroText .= "and "; $heroText .= $deathCommunity." community member"; if($deathCommunity !== 1) $heroText .= "s"; }
        $heroText .= (count($omenCollection->getOmens()) > 1) ? ". Ususally, it" : ". It";
        $heroText .= " was ".$omenCollection->getCommonFault()." fault."; 

        return $heroText;

    }

}