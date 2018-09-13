<?php

namespace Mazecon\TopicBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MazeconTopicBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
