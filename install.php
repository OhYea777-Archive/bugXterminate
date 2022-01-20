/**
 * bugXterminate
 *
 * bugXterminate is developed by Daxalon and is a free open source software licensed under the Apache 2.0 license.
 *
 * www.bugxterminate.com
 * www.daxalon.com
 *
 * 
 *  Copyright 2015 Daxalon
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */


CREATE TABLE IF NOT EXISTS `bx_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `registerdate` varchar(50) NOT NULL,
  `lastactivity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `bx_usertokens` (
  `id` int(11) NOT NULL,
  `uniqueid` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `bx_useractivations` (
  `id` int(11) NOT NULL,
  `uniqueid` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `bx_cases` (
  `id` int(11) NOT NULL,
  `uniqueid` varchar(50) NOT NULL,
  `author` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;



ALTER TABLE `bx_users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `bx_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bx_usertokens`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `bx_usertokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bx_useractivations`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `bx_useractivations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bx_cases`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `bx_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;