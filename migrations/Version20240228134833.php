<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228134833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE emotionnal_security_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_session_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE physical_table_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rpg_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE scenario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE author (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE emotionnal_security (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, status_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, starting_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ending_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, reservation_starting_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, reservation_ending_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, table_creation_starting_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, table_creation_ending_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3BAE0AA76BF700BD ON event (status_id)');
        $this->addSql('CREATE TABLE game_session (id INT NOT NULL, scenario_id INT DEFAULT NULL, rpg_id INT DEFAULT NULL, status_id INT NOT NULL, emotionnal_security_id INT NOT NULL, role_id INT DEFAULT NULL, starting_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ending_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, min_players SMALLINT NOT NULL, max_players SMALLINT NOT NULL, mj_number SMALLINT NOT NULL, synopsis TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4586AAFBE04E49DF ON game_session (scenario_id)');
        $this->addSql('CREATE INDEX IDX_4586AAFB310B3E3E ON game_session (rpg_id)');
        $this->addSql('CREATE INDEX IDX_4586AAFB6BF700BD ON game_session (status_id)');
        $this->addSql('CREATE INDEX IDX_4586AAFB79D89415 ON game_session (emotionnal_security_id)');
        $this->addSql('CREATE INDEX IDX_4586AAFBD60322AC ON game_session (role_id)');
        $this->addSql('CREATE TABLE game_session_genre (game_session_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(game_session_id, genre_id))');
        $this->addSql('CREATE INDEX IDX_F2C917458FE32B32 ON game_session_genre (game_session_id)');
        $this->addSql('CREATE INDEX IDX_F2C917454296D31F ON game_session_genre (genre_id)');
        $this->addSql('CREATE TABLE game_session_player_category (game_session_id INT NOT NULL, player_category_id INT NOT NULL, PRIMARY KEY(game_session_id, player_category_id))');
        $this->addSql('CREATE INDEX IDX_DE5EFF428FE32B32 ON game_session_player_category (game_session_id)');
        $this->addSql('CREATE INDEX IDX_DE5EFF424A717477 ON game_session_player_category (player_category_id)');
        $this->addSql('CREATE TABLE game_session_game_masters (game_session_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(game_session_id, user_id))');
        $this->addSql('CREATE INDEX IDX_335B25BE8FE32B32 ON game_session_game_masters (game_session_id)');
        $this->addSql('CREATE INDEX IDX_335B25BEA76ED395 ON game_session_game_masters (user_id)');
        $this->addSql('CREATE TABLE game_session_players (game_session_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(game_session_id, user_id))');
        $this->addSql('CREATE INDEX IDX_4B26061B8FE32B32 ON game_session_players (game_session_id)');
        $this->addSql('CREATE INDEX IDX_4B26061BA76ED395 ON game_session_players (user_id)');
        $this->addSql('CREATE TABLE genre (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE physical_table (id INT NOT NULL, event_id INT NOT NULL, seating SMALLINT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_649F9A3071F7E88B ON physical_table (event_id)');
        $this->addSql('CREATE TABLE player_category (id INT NOT NULL, category VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rpg (id INT NOT NULL, name VARCHAR(255) NOT NULL, isbn INT NOT NULL, grog_link VARCHAR(2080) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rpg_author (rpg_id INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY(rpg_id, author_id))');
        $this->addSql('CREATE INDEX IDX_E24BB791310B3E3E ON rpg_author (rpg_id)');
        $this->addSql('CREATE INDEX IDX_E24BB791F675F31B ON rpg_author (author_id)');
        $this->addSql('CREATE TABLE scenario (id INT NOT NULL, name VARCHAR(255) NOT NULL, grog_link VARCHAR(2080) DEFAULT NULL, isbn INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE scenario_author (scenario_id INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY(scenario_id, author_id))');
        $this->addSql('CREATE INDEX IDX_A1ECB61BE04E49DF ON scenario_author (scenario_id)');
        $this->addSql('CREATE INDEX IDX_A1ECB61BF675F31B ON scenario_author (author_id)');
        $this->addSql('CREATE TABLE status (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, discord VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, membership_end_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(user_id, role_id))');
        $this->addSql('CREATE INDEX IDX_2DE8C6A3A76ED395 ON user_role (user_id)');
        $this->addSql('CREATE INDEX IDX_2DE8C6A3D60322AC ON user_role (role_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA76BF700BD FOREIGN KEY (status_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBE04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFB310B3E3E FOREIGN KEY (rpg_id) REFERENCES rpg (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFB6BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFB79D89415 FOREIGN KEY (emotionnal_security_id) REFERENCES emotionnal_security (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBD60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_genre ADD CONSTRAINT FK_F2C917458FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_genre ADD CONSTRAINT FK_F2C917454296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_player_category ADD CONSTRAINT FK_DE5EFF428FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_player_category ADD CONSTRAINT FK_DE5EFF424A717477 FOREIGN KEY (player_category_id) REFERENCES player_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_game_masters ADD CONSTRAINT FK_335B25BE8FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_game_masters ADD CONSTRAINT FK_335B25BEA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_players ADD CONSTRAINT FK_4B26061B8FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_players ADD CONSTRAINT FK_4B26061BA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE physical_table ADD CONSTRAINT FK_649F9A3071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rpg_author ADD CONSTRAINT FK_E24BB791310B3E3E FOREIGN KEY (rpg_id) REFERENCES rpg (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rpg_author ADD CONSTRAINT FK_E24BB791F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE scenario_author ADD CONSTRAINT FK_A1ECB61BE04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE scenario_author ADD CONSTRAINT FK_A1ECB61BF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE emotionnal_security_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_session_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE genre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE physical_table_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rpg_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE scenario_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA76BF700BD');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBE04E49DF');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFB310B3E3E');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFB6BF700BD');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFB79D89415');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBD60322AC');
        $this->addSql('ALTER TABLE game_session_genre DROP CONSTRAINT FK_F2C917458FE32B32');
        $this->addSql('ALTER TABLE game_session_genre DROP CONSTRAINT FK_F2C917454296D31F');
        $this->addSql('ALTER TABLE game_session_player_category DROP CONSTRAINT FK_DE5EFF428FE32B32');
        $this->addSql('ALTER TABLE game_session_player_category DROP CONSTRAINT FK_DE5EFF424A717477');
        $this->addSql('ALTER TABLE game_session_game_masters DROP CONSTRAINT FK_335B25BE8FE32B32');
        $this->addSql('ALTER TABLE game_session_game_masters DROP CONSTRAINT FK_335B25BEA76ED395');
        $this->addSql('ALTER TABLE game_session_players DROP CONSTRAINT FK_4B26061B8FE32B32');
        $this->addSql('ALTER TABLE game_session_players DROP CONSTRAINT FK_4B26061BA76ED395');
        $this->addSql('ALTER TABLE physical_table DROP CONSTRAINT FK_649F9A3071F7E88B');
        $this->addSql('ALTER TABLE rpg_author DROP CONSTRAINT FK_E24BB791310B3E3E');
        $this->addSql('ALTER TABLE rpg_author DROP CONSTRAINT FK_E24BB791F675F31B');
        $this->addSql('ALTER TABLE scenario_author DROP CONSTRAINT FK_A1ECB61BE04E49DF');
        $this->addSql('ALTER TABLE scenario_author DROP CONSTRAINT FK_A1ECB61BF675F31B');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3D60322AC');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE emotionnal_security');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE game_session');
        $this->addSql('DROP TABLE game_session_genre');
        $this->addSql('DROP TABLE game_session_player_category');
        $this->addSql('DROP TABLE game_session_game_masters');
        $this->addSql('DROP TABLE game_session_players');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE physical_table');
        $this->addSql('DROP TABLE player_category');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE rpg');
        $this->addSql('DROP TABLE rpg_author');
        $this->addSql('DROP TABLE scenario');
        $this->addSql('DROP TABLE scenario_author');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
