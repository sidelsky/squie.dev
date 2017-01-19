#!/bin/bash

fancy_echo() {
  local fmt="$1"; shift

  # shellcheck disable=SC2059
  printf "\n\033[32;1m$fmt\n\033[0m" "$@"
}

ask_to_start_over() {
	fancy_echo "You data is invalid, would you like to start over? [yes/no]"
	read -r anwser
	if [[ "$anwser" == "yes" ]]; then
		echo "Starting over..."
		user_input
	else
		echo "Script ended"
		exit 1
	fi
}

ask_about_db() {
	fancy_echo "Would you like to create and import default Database? [yes/no]"
	read -r IMPORTDB
	if [[ "$IMPORTDB" == "yes" ]]; then
		echo "Database's username (root):"
		read -r DBUSER
		if [ -z "$DBUSER" ]; then
		    echo "Setting user to root"
		    DBUSER="root"
		fi
		echo "Database's password (press enter to skip):"
		read -r DBPASS
		if [ -z "$DBPASS" ]; then
			echo "Using no possword"
			DBCONN="-u $DBUSER"
		else
			DBCONN="-u $DBUSER -p$DBPASS"
		fi
	fi
}

ask_to_proceed() {
	fancy_echo "Is that all correct? [yes/no]"
	read -r anwser
	if [[ "$anwser" == "yes" ]]; then
		start_replacement
	else
		echo "Script ended"
		exit 1
	fi
}

start_replacement() {
	fancy_echo "Seting up your project..."
	THEMESLUG="$PROJECTSLUG-theme"
	sed -i "" -e "s=###VHOST###=$VHOST=" gulpfile.js databases/breakthrough-starter.sql
	sed -i "" -e "s=###PROJECTTITLE###=$PROJECTTITLE=" package.json bower.json databases/breakthrough-starter.sql
	sed -i "" -e "s=###GITREPO###=$GITREPO=" package.json bower.json
	sed -i "" -e "s=###PROJECTSLUG###=$PROJECTSLUG=" package.json bower.json databases/breakthrough-starter.sql public/wp-config.development.php vhosts/master.conf
	sed -i "" -e "s=###THEMESLUG###=$THEMESLUG=" gulpfile.js databases/breakthrough-starter.sql
	sed -i "" -e "s=###THEMENAME###=$PROJECTTITLE=" public/wp-content/themes/starter-theme/style.css
	sed -i "" -e "s=###REPONAME###=$REPONAME=" vhosts/staging.conf vhosts/master.conf public/wp-config.env.php
	find ./public/wp-content/themes/starter-theme/ -type f -name "*.php" -exec sed -i "" -e "s=###THEMESLUG###=$THEMESLUG=" {} \;

	if [[ "$IMPORTDB" == "yes" ]]; then
		echo "Creating DB"
		mysql $DBCONN -e "CREATE DATABASE \`$PROJECTSLUG\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
		if [ $? -eq 0 ]; then
            echo "Create successful"
            echo "Import database $PROJECTSLUG"
            mysql $DBCONN $PROJECTSLUG < databases/breakthrough-starter.sql
            if [ $? -eq 0 ]; then
            	echo "Import successful"
				sed -i "" -e "s=###DBPASS###=$DBPASS=" public/wp-config.development.php
				sed -i "" -e "s=###DBUSER###=$DBUSER=" public/wp-config.development.php
            fi
        fi
	fi

	mv public/wp-content/themes/starter-theme public/wp-content/themes/$THEMESLUG
	mv databases/breakthrough-starter.sql databases/$PROJECTSLUG.sql
	fancy_echo "Set up ended"
}

check_empty() {
	local val="$1"
	if [ -z "$val" ]; then
	    echo "Value can't be empty"
	    ask_to_start_over
	fi
}

check_slug() {
	local val="$1"
	if [[ "$val" =~ ^[A-z0-9_-]*$ ]]; then
	    return 0
	else
	    echo "Valid value, allowed characters are [A-z0-9_-]"
	    ask_to_start_over
	fi
}

show_summary() {
	fancy_echo "You provided this info:"
	echo "Project's title: $PROJECTTITLE"
	echo "Project's slug: $PROJECTSLUG"
	echo "Git repository: $GITREPO"
	echo "Project's local url: $VHOST"
	echo "Create and Import DB: $IMPORTDB"
	if [[ "$IMPORTDB" == "yes" ]]; then
		echo "DB username: $DBUSER"
		if [ -z "$DBPASS" ]; then
			echo "DB password: (empty)"
		else
			echo "DB password: $DBPASS"
		fi
	fi
}

user_input() {
	fancy_echo "Please give more details about this project"
	echo "Project's title:"
	read -r PROJECTTITLE
	check_empty "$PROJECTTITLE"
	echo "Project's lowercase slug [A-z0-9_-]:"
	read -r PROJECTSLUG
	check_empty "$PROJECTSLUG"
	check_slug "$PROJECTSLUG"
	echo "Git repository (https format from beanstalk):"
	read -r GITREPO
	check_empty "$GITREPO"
  REPONAME=$(echo "$GITREPO" | grep -o '/([a-z-]*)(/|.git)?$' | sed 's,/,,g' | sed 's,.git,,')
	echo "Project's local url (include http://):"
	read -r VHOST
	check_empty "$VHOST"
	ask_about_db

	show_summary
	ask_to_proceed
}

fancy_echo "Wordpress startup script"
user_input

# echo -e "Hi, please type the word: \c "
# read  word
# echo "The word you entered is: $word"
# echo -e "Can you please enter two words? "
# read word1 word2
# echo "Here is your input: \"$word1\" \"$word2\""
# echo -e "How do you feel about bash scripting? "
# # read command now stores a reply into the default build-in variable $REPLY
# read
# echo "You said $REPLY, I'm glad to hear that! "
# echo -e "What are your favorite colours ? "
# # -a makes read command to read into an array
# read -a colours
# echo "My favorite colours are also ${colours[0]}, ${colours[1]} and ${colours[2]}:-)"
