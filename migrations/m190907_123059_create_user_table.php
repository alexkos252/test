<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190907_123059_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        //create table `user`
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
        ]);
        
        
        //Дамп данных таблицы `user`
        $this->insert('user',array(
            'id'=>'1',
            'username' =>'admin',
            'password' => "$2y$13$"."Miyajsj0.4VrZ5lcziNtwOU/IDA5bdgL5cCYrofsI20BnBZIr7hhS",
            'authKey' =>'kh54dLztte2ChwD3__kDKssE84sjJB7K',
            'accessToken' =>'',
        ));
        $this->insert('user',array(
            'id'=>'2',
            'username' =>'author',
            'password' => "$2y$13$"."t9t8KZzXRyuRPcNkcSPN9.RDolbrcKEgRJnbkxnb9taY0.UI9OmXy",
            'authKey' =>'C-ASNcbWE4uH4Vd6Tg7jIkS5ld4Cq1F2',
            'accessToken' =>'',
        ));
        $this->insert('user',array(
            'id'=>'3',
            'username' =>'user',
            'password' => "$2y$13$"."wynxN0R2kjw1p7XnY24aA.kOc3CCyhLr/ZuQb8h3QDvT2qk4cdjXu",
            'authKey' =>'0UX16TbnjTm8RPskm-0SvjWdnEwx-AZP',
            'accessToken' =>'',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
