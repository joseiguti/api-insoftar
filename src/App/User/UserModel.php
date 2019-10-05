<?php
declare(strict_types=1);

namespace App\User;

use App\Exception;
use DomainException;
use PDOException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbTableGateway;
use Zend\Paginator\Paginator;

class UserModel
{
    private $table;

    public function __construct(AdapterInterface $adapter)
    {
        $resultSet = new HydratingResultSet();
        $resultSet->setObjectPrototype(new UserEntity());
        $this->table = new TableGateway('usuarios', $adapter, null, $resultSet);
    }

    /**
     * Get all user
     */
    public function getAll(): Paginator
    {
        $dbTableGatewayAdapter = new DbTableGateway($this->table);
        $paginator = new UserCollection($dbTableGatewayAdapter);
        return $paginator;
    }

    /**
     * Get a user by $id
     *
     * @throws Exception\NoResourceFoundException
     */
    public function getUser(int $id): UserEntity
    {
        $user = $this->table->select([ 'id' => $id ]);
        $result = $user->current();
        if (! $result instanceof UserEntity) {
            throw Exception\NoResourceFoundException::create('User not found');
        }
        return $result;
    }

    /**
     * Add a user with $data values
     *
     * @throws Exception\InvalidParameterException if the data is not valid.
     * @throws Exception\RuntimeException if an error occurs during insert.
     */
    public function addUser(array $data, UserInputFilter $inputFilter): int
    {
        $inputFilter->setData($data);
        if (! $inputFilter->isValid()) {
            throw Exception\InvalidParameterException::create(
                'Invalid parameter',
                $inputFilter->getMessages()
            );
        }

        $data = $inputFilter->getValues();

        $rows = $this->table->insert($data);
        
        $id = $rows === 1 ? $this->table->lastInsertValue : null;

        if ($id === null) {
            throw Exception\RuntimeException::create(
                'Oops, something went wrong. Please contact the administrator'
            );
        }

        return (int) $id;
    }
    
    /**
     * Busca un usuario por los datos suministrados
     * 
     * @param array $data
     * @param UserInputFilter $inputFilter
     * @return int
     */
    public function findUser (array $data, UserInputFilter $inputFilter): int
    {
        $inputFilter->setData($data);
        
        $inputFilter->get('nombre')->setRequired(false);
        
        $inputFilter->get('apellidos')->setRequired(false);
        
        $inputFilter->get('cedula')->setRequired(false);
        
        $inputFilter->get('correo')->setRequired(false);
        
        $inputFilter->get('telefono')->setRequired(false);
        
        $data = $inputFilter->getValues();
        
        foreach ($data as $id => $value){
            
            if (is_null($data[$id])){
                
                unset($data[$id]);
            }
        }
        
        $rowset = $this->table->select($data);
        
        $userRow = $rowset->current();
        
        $id = $userRow ? $userRow->id : null;
        
        if ($id === null) {
            throw Exception\RuntimeException::create(
                'User does not exist'
                );
        }
        
        return (int) $id;
    }

    /**
     * Update the user with $id and $data
     *
     * @throws Exception\InvalidParameterException if the data is not valid.
     * @throws Exception\NoResourceFoundException if no rows are returned by
     *     the update operation.
     */
    public function updateUser(int $id, array $data, UserInputFilter $inputFilter): UserEntity
    {
        $inputFilter->setData($data);
        
        $inputFilter->get('nombre')->setRequired(false);
        
        $inputFilter->get('apellidos')->setRequired(false);
        
        $inputFilter->get('cedula')->setRequired(false);
        
        $inputFilter->get('correo')->setRequired(false);
        
        $inputFilter->get('telefono')->setRequired(false);
        
        if (! $inputFilter->isValid()) {
            throw Exception\InvalidParameterException::create(
                'Invalid parameter',
                $inputFilter->getMessages()
            );
        }
        
        try {
            $rows = $this->table->update($data, [ 'id' => $id ]);
        } catch (PDOException $e) {
            throw Exception\RuntimeException::create(
                'Oops, something went wrong. Please contact the administrator'
            );
        }

        $user = $rows === 1 ? $this->getUser($id) : null;

        if (! $user) {
            throw Exception\NoResourceFoundException::create('User not found');
        }

        return $user;
    }

    /**
     * Remove the user with $id
     *
     * @throws Exception\NoResourceFoundException if no rows are returned by
     *     the delete operation.
     */
    public function deleteUser($id): bool
    {
        $rows = $this->table->delete([ 'id' => $id ]);
        $result = $rows === 1;

        if (! $result) {
            throw Exception\NoResourceFoundException::create('User not found');
        }

        return true;
    }
}
