<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180606164548 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vanduo DROP FOREIGN KEY FK_D3890334A76ED395');
        $this->addSql('DROP INDEX UNIQ_D3890334A76ED395 ON vanduo');
        $this->addSql('ALTER TABLE vanduo ADD userid INT NOT NULL, DROP user_id, CHANGE date date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vanduo ADD user_id INT DEFAULT NULL, DROP userid, CHANGE date date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE vanduo ADD CONSTRAINT FK_D3890334A76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D3890334A76ED395 ON vanduo (user_id)');
    }
}
