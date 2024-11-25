<?php

namespace App;

enum Status: string
{
    case Pending='pending';
    case Active='active';
    case Inactive='inactive';
    case Archived='archived';
    case Deleted='deleted';
}
