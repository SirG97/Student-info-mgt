<?php
echo md5('singingrocktest');
echo  password_verify('password1', md5('password1'));