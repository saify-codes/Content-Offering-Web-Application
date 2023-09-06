<?php

function keygen(): string{
    return 'COWA-' . strtoupper(substr(uniqid(), 0, 8)) . '-' . strtoupper(bin2hex(random_bytes(4))) . '-' . strtoupper(bin2hex(random_bytes(4)));
}
