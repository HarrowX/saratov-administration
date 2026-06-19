<?php

namespace App\Enums;
enum VisitedStatus: string
{
    case Visited = 'visited';
    case SemiVisited = 'semi-visited';
    case NotVisited = 'not-visited';

}
