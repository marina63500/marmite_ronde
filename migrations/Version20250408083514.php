<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408083514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE recipe_ingredient (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_22D1FE1359D8A214 (recipe_id), INDEX IDX_22D1FE13933FE08C (ingredient_id), PRIMARY KEY(recipe_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD recipe_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9474526C59D8A214 ON comment (recipe_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite ADD recipe_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED959D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_68C58ED959D8A214 ON favorite (recipe_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_68C58ED9A76ED395 ON favorite (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` ADD recipe_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AC6340B359D8A214 ON `like` (recipe_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AC6340B3A76ED395 ON `like` (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD user_id INT DEFAULT NULL, ADD media_id INT NOT NULL, ADD difficult_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13787127583 FOREIGN KEY (difficult_id) REFERENCES difficult (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DA88B137A76ED395 ON recipe (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_DA88B137EA9FDD75 ON recipe (media_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DA88B13787127583 ON recipe (difficult_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE1359D8A214
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE13933FE08C
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE recipe_ingredient
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137EA9FDD75
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13787127583
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_DA88B137A76ED395 ON recipe
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_DA88B137EA9FDD75 ON recipe
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_DA88B13787127583 ON recipe
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP user_id, DROP media_id, DROP difficult_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED959D8A214
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_68C58ED959D8A214 ON favorite
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_68C58ED9A76ED395 ON favorite
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite DROP recipe_id, DROP user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526C59D8A214
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_9474526C59D8A214 ON comment
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_9474526CA76ED395 ON comment
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP recipe_id, DROP user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B359D8A214
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_AC6340B359D8A214 ON `like`
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_AC6340B3A76ED395 ON `like`
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` DROP recipe_id, DROP user_id
        SQL);
    }
}
