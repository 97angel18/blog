<?php

function setActiveRoute($name)
{
    return request()->routeIs($name) ? 'active' : '';
}
function setActiveMenu($name)
{
    return request()->is($name) ? 'menu-open' : '';
}

function setActiveCreate($name)
{
    return request()->is($name) ? 'active': '';
}
