<?php

namespace Pace;

use InvalidArgumentException;

class Type
{
    /**
     * The type name.
     *
     * @var string
     */
    protected $name;

    /**
     * Object type names with adjacent uppercase letters.
     *
     * @var array
     */
    protected static $irregularNames = [
        'apSetup' => 'APSetup',
        'arSetup' => 'ARSetup',
        'crmSetup' => 'CRMSetup',
        'crmStatus' => 'CRMStatus',
        'crmUser' => 'CRMUser',
        'csr' => 'CSR',
        'dsfMediaSize' => 'DSFMediaSize',
        'dsfOrderStatus' => 'DSFOrderStatus',
        'faSetup' => 'FASetup',
        'glAccount' => 'GLAccount',
        'glAccountBalance' => 'GLAccountBalance',
        'glAccountBalanceSummary' => 'GLAccountBalanceSummary',
        'glAccountBudget' => 'GLAccountBudget',
        'glAccountingPeriod' => 'GLAccountingPeriod',
        'glBatch' => 'GLBatch',
        'glDepartment' => 'GLDepartment',
        'glDepartmentLocation' => 'GLDepartmentLocation',
        'glJournalEntry' => 'GLJournalEntry',
        'glJournalEntryAudit' => 'GLJournalEntryAudit',
        'glLocation' => 'GLLocation',
        'glRegisterNumber' => 'GLRegisterNumber',
        'glSchedule' => 'GLSchedule',
        'glScheduleLine' => 'GLScheduleLine',
        'glSetup' => 'GLSetup',
        'glSplit' => 'GLSplit',
        'glSummaryName' => 'GLSummaryName',
        'jmfReceivedMessage' => 'JMFReceivedMessage',
        'jmfReceivedMessagePartition' => 'JMFReceivedMessagePartition',
        'jmfReceivedMessageTransaction' => 'JMFReceivedMessageTransaction',
        'jmfReceivedMessageTransactionPartition' => 'JMFReceivedMessageTransactionPartition',
        'poSetup' => 'POSetup',
        'poStatus' => 'POStatus',
        'rssChannel' => 'RSSChannel',
        'uom' => 'UOM',
        'uomDimension' => 'UOMDimension',
        'uomRange' => 'UOMRange',
        'uomSetup' => 'UOMSetup',
        'uomType' => 'UOMType',
        'wipCategory' => 'WIPCategory'
    ];

    /**
     * Create a new instance.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        if (!preg_match('/^([A-Z]+[a-z]*)+$/', $name)) {
            throw new InvalidArgumentException('Type name must be in StudlyCaps.');
        }

        $this->name = $name;
    }

    /**
     * Create a new instance from a property name.
     *
     * @param string $name
     * @return Type
     */
    public static function fromPropertyName($name)
    {
        if (array_key_exists($name, static::$irregularNames)) {
            return new static(static::$irregularNames[$name]);
        }

        return new static(ucfirst($name));
    }

    /**
     * Get the property name.
     *
     * @return string
     */
    public function propertyName()
    {
        return array_search($this->name, static::$irregularNames) ?: $this->camelCaseName();
    }

    /**
     * Get the camel-cased type name.
     *
     * @return string
     */
    public function camelCaseName()
    {
        return lcfirst($this->name);
    }

    /**
     * Get the type name.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Convert the instance to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name();
    }
}