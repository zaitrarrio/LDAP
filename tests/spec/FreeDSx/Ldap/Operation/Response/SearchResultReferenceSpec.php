<?php
/**
 * This file is part of the FreeDSx package.
 *
 * (c) Chad Sikorra <Chad.Sikorra@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\FreeDSx\Ldap\Operation\Response;

use FreeDSx\Ldap\Asn1\Asn1;
use FreeDSx\Ldap\LdapUrl;
use FreeDSx\Ldap\Operation\Response\SearchResultReference;
use PhpSpec\ObjectBehavior;

class SearchResultReferenceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new LdapUrl('foo'), new LdapUrl('bar'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SearchResultReference::class);
    }

    function it_should_get_the_referrals()
    {
        $this->getReferrals()->shouldBeLike([
            new LdapUrl('foo'),
            new LdapUrl('bar')
        ]);
    }

    function it_should_be_constructed_from_asn1()
    {
        $this->beConstructedThrough('fromAsn1', [Asn1::application(19, Asn1::sequenceOf(
            Asn1::ldapString('ldap://foo'),
            Asn1::ldapString('ldap://bar')
        ))]);

        $this->getReferrals()->shouldBeLike([
            new LdapUrl('foo'),
            new LdapUrl('bar')
        ]);
    }
}
